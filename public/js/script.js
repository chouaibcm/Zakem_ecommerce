$(document).ready(function(){
    $(".data-table").each(function(_, table){
        $(table).DataTable();
    });  
    // // image preview
    $(".image").change(function () {
        
        if (this.files && this.files[0]) {
            var reader = new FileReader();
    
            reader.onload = function (e) {
                $('.image-preview').attr('src', e.target.result);
            }
    
            reader.readAsDataURL(this.files[0]);
        }
    
    });
    // // image preview
    $(".image2").change(function () {
        
        if (this.files && this.files[0]) {
            var reader = new FileReader();
    
            reader.onload = function (e) {
                $('.image-preview2').attr('src', e.target.result);
            }
    
            reader.readAsDataURL(this.files[0]);
        }
    
    });  
});
