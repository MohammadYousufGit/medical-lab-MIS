$(document).ready(function () {
            $('.select2').select2();
            var select2 = document.getElementById("select2");
            var submitButton = document.getElementById("submitButton");
            var sum = 0;
            var total = sum;
            var discount = 0;
            var payed = 0;
            $("#submitButton").click(function () {

                for(e of select2.options){
                    if(e.selected){
                        sum = sum + parseInt(e.id);
                    }
                }
                //end of for loop
                document.getElementById("grant").value = sum;
                document.getElementById("total").value = sum;
				total = sum;
            });

           
            $('#discount').keyup(function () {

                 discount= document.getElementById('discount').value;

                 if (discount <0 ) {
                 	alert("Discount could not be null!");
                 }
                 else{

                 	if(discount!=null)
                    showTotal();
                else{
                	discount = 0;
                	showTotal();

                } 
                 }
                
            });

		function showTotal() {


            document.getElementById("total").value = total - discount;
        }
        });