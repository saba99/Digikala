<template>
    <div>


        <div class="search_form">
            <input type="text" v-model="search_text" class="form-control" placeholder="نام محصول ...">
            <button class="btn btn-primary" v-on:click="getWarrantyList(1)">جست و جو</button>
        </div>

        <table class="table table-bordered">
            <thead>
              <tr>
                  <th>ردیف</th>
                  <th>تصویر</th>
                  <th>عنوان محصول</th>
                  <th>فروشنده</th>
                  <th>گارانتی</th>
                  <th>رنگ</th>
                  <th>عملیات</th>
              </tr>
            </thead>

            <tbody>
                <tr v-for="(item,key) in WarrantyList.data">
                    <td>{{ getRow(key) }}</td>
                    <td>
                        <img v-bind:src="$siteUrl+'/files/thumbnails/'+item.get_product.image_url" class="product_pic"/>
                    </td>
                    <td style="font-size:14px">
                        {{ item.get_product.title }}
                    </td>
                    <td></td>
                    <td style="font-size:14px">
                        {{ item.get_warranty.name }}
                    </td>
                    <td style="width:100px">
                       <span v-if="item.get_color.id>0" v-bind:style="[item.get_color.id>0 ? {background:'#'+item.get_color.code} : {}]" class="color_td">
                            <span v-if="item.get_color.id>0" v-bind:style="[item.get_color.name=='سفید' ? {color:'black'} : {color:'white'}]">
                              {{ item.get_color.name }}
                           </span>
                       </span>
                    </td>
                    <td style="width:100px">
                        <p class="select_item" v-on:click="show_box(item.id,key)">انتخاب</p>
                        <p v-if="item.offers==1" v-on:click="remove_offers(item.id,key)" class="remove_item">حذف</p>
                    </td>
                </tr>
            </tbody>
        </table>

        <pagination :data="WarrantyList" @pagination-change-page="getWarrantyList"></pagination>

        <div class="message_div" style="display:block" v-if="show_message_box">
            <div class="message_box">
                <p id="msg">آیا از حذف این محصول از لیست پیشنهاد شگفت انگیز مطمین هستین ؟‌</p>
                <a class="alert alert-success" v-on:click="remove_of_list()">بله</a>
                <a class="alert alert-danger" v-on:click="show_message_box=!show_message_box">خیر</a>
            </div>

        </div>

       <div class="modal fade" id="priceBox" role="dialog">
           <div class="modal-dialog modal-lg">
               <div class="modal-content">
                   <div class="modal-header">
                       <h5>  افزودن به لیست پیشنهاد شگفت انگیز </h5>
                       <button type="button" class="close" data-dismiss="modal">
                           ×
                       </button>
                   </div>
                   <div class="modal-body">

                      <div v-if="server_errors" class="alert alert-warning">
                          <ul class="list-inline">
                              <li v-for="error in server_errors">
                                  {{ error[0] }}</li>
                          </ul>
                      </div>

                       <div class="form-group">
                           <label>هزینه محصول : </label>
                           <cleave :options="options" v-model="formInput.price1" class="form-control left" ></cleave>
                           <span class="has_error" v-if="errors.price1_error">{{ errors.price1_error }}</span>
                       </div>
                       <div class="form-group">
                           <label>هزینه محصول برای فروش : </label>
                           <cleave :options="options" v-model="formInput.price2" class="form-control left" ></cleave>
                           <span class="has_error" v-if="errors.price2_error">{{ errors.price2_error }}</span>
                       </div>

                       <div class="form-group">
                           <label>تعداد موجودی محصول : </label>
                           <cleave :options="options" v-model="formInput.product_number" class="form-control left" ></cleave>

                           <span class="has_error" v-if="errors.product_number_error">{{ errors.product_number_error }}</span>
                       </div>

                       <div class="form-group">
                           <label>تعداد قابل سفارش در سبد خرید : </label>
                           <cleave :options="options" v-model="formInput.product_number_cart" class="form-control left" ></cleave>
                           <span class="has_error" v-if="errors.product_number_cart_error">{{ errors.product_number_cart_error }}</span>
                       </div>

                       <div class="form-group">
                           <label>تاریخ شروع : </label>
                           <input type="text" v-model="date1" id="pcal1" class="form-control" style="text-align:center" />
                       </div>

                       <div class="form-group">
                           <label>تاریخ پایان : </label>
                           <input type="text" v-model="date2" id="pcal2" class="form-control" style="text-align:center" />
                       </div>
                   </div>
                   <div class="modal-footer">
                       <button class="btn btn-primary" v-on:click="add()">افزودن</button>
                   </div>

          </div>
       </div>

       </div>
    </div>

</template>

<script>
    export default {

        name: "IncredibleOffers",
        data(){
            return {
                WarrantyList:{data:[]},
                page:1,
                formInput:{
                    price1:'',
                    price2:'',
                    product_number:'',
                    product_number_cart:''
                },
                options:{
                    numeral:true
                },
                date1:'',
                date2:'',
                select_key:-1,
                warranty_id:-1,
                send_form:true,
                show_message_box:false,
                errors:{
                    price1_error:false,
                    price2_error:false,
                    product_number_error:false,
                    product_number_cart_error:false,
                },
                label:{
                    price1:'هزینه محصول',
                    price2:'هزینه محصول برای فروش',
                    product_number:'تعداد موجودی محصول',
                    product_number_cart:'تعداد قابل سفارش در سبد خرید',
                },
                search_text:'',
                server_errors:null
            }
        },
        mounted(){
            this.getWarrantyList(1);
        },
        methods:{
            getWarrantyList:function (page) {
                this.page=page;
                const url=this.$siteUrl+'/admin/ajax/getWarranty?page='+page+"&search_text="+this.search_text;
                this.axios.get(url).then(response=>{
                    this.WarrantyList=response.data;
                });
            },
            getRow:function (index) {
                ++index;
                let k=(this.page-1)*10;
                k=k+index;
                return this.replaceNumber(k);
            },
            replaceNumber:function (n) {
                n=n.toString();
                const find=["0","1","2","3","4","5","6","7","8","9"];
                const replace=["۰","۱","۲","۳","۴","۵","۶","۷","۸","۹"];
                for (let i=0;i<find.length;i++)
                {
                    n=n.replace(new RegExp(find[i],'g'),replace[i]);
                }
                return n;
            },
            show_box:function (item_id,key) {
                if(this.send_form==true)
                {
                    this.server_errors=false;
                    this.warranty_id=item_id;
                    this.select_key=key;
                    this.formInput.price1=this.WarrantyList.data[key].price1;
                    this.formInput.price2=this.WarrantyList.data[key].price2;
                    this.formInput.product_number=this.WarrantyList.data[key].product_number;
                    this.formInput.product_number_cart=this.WarrantyList.data[key].product_number_cart;
                    this.date1=this.WarrantyList.data[this.select_key].offers_first_date;
                    this.date2=this.WarrantyList.data[this.select_key].offers_last_date;
                    $("#priceBox").modal('show');
                }
            },
            add:function () {

                this.date1=$("#pcal1").val();
                this.date2=$("#pcal2").val();
                if(this.validateForm())
                {
                    this.send_form=false;
                    const formData=new FormData();
                    formData.append('price1',this.formInput.price1);
                    formData.append('price2',this.formInput.price2);
                    formData.append('product_number',this.formInput.product_number);
                    formData.append('product_number_cart',this.formInput.product_number_cart);
                    formData.append('date1',this.date1);
                    formData.append('date2',this.date2);

                    const url=this.$siteUrl+"/admin/add_incredible_offers/"+this.warranty_id;
                    this.axios.post(url,formData).then(response=>{

                        if(response.data=='ok')
                        {
                            this.send_form=true;
                            $("#priceBox").modal('hide');
                            this.WarrantyList.data[this.select_key].offers=1;
                            this.WarrantyList.data[this.select_key].price1=this.formInput.price1;
                            this.WarrantyList.data[this.select_key].price2=this.formInput.price2;
                            this.WarrantyList.data[this.select_key].product_number=this.formInput.product_number;
                            this.WarrantyList.data[this.select_key].product_number_cart=this.formInput.product_number_cart;
                            this.WarrantyList.data[this.select_key].offers_first_date=this.date1;
                            this.WarrantyList.data[this.select_key].offers_last_date=this.date2;
                        }
                        else if (response.data.error!=undefined)
                        {
                            this.send_form=true;
                        }
                        else{
                            this.server_errors=response.data;
                            this.send_form=true;
                        }
                    });
                }
            },
            remove_offers:function (item_id,key) {
                this.warranty_id=item_id;
                this.select_key=key;
                this.show_message_box=true;
            },
            remove_of_list:function () {
                this.show_message_box=false;
                const url=this.$siteUrl+"/admin/remove_incredible_offers/"+this.warranty_id;
                this.axios.post(url).then(response=>{

                    if(response.data!='error')
                    {
                        this.WarrantyList.data[this.select_key].offers=0;
                        this.WarrantyList.data[this.select_key].price1=response.data.price1;
                        this.WarrantyList.data[this.select_key].price2=response.data.price2;
                        this.WarrantyList.data[this.select_key].product_number=response.data.product_number;
                        this.WarrantyList.data[this.select_key].product_number_cart=response.data.product_number_cart;

                    }
                });
            },
            validateForm:function ()
            {
                 let result=true;
                 for(let formInputKey in this.formInput)
                 {
                     let  k=formInputKey+"_error";
                     if(this.formInput[formInputKey].toString().trim().length==0)
                     {
                         let message=this.label[formInputKey]+" نمی تواند خالی باشد";
                         this.errors[k]=message;
                         result=false;
                     }
                     else {
                         this.errors[k]=false;
                     }
                 }
                 return result;
            }
        }
    }
</script>

<style scoped>
.message_box{
    width:483px !important;
}
</style>
