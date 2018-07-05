<div class="wrap">
<style>
form.add_slide_form p label{
width:200px;
display:block;
float:left;
font-size:14px;
}
input[type='text'],textarea{
background-color: #fff;
    font-size: 1.7em;
    height: 1.7em;
    line-height: 100%;
    margin: 0;
    outline: 0 none;
    padding: 3px 8px;
    width: 500px;
}
textarea{
height:200px;
}
</style>

<h2>Please attach your files</h2>
			<form action=""  method="post" class="add_slide_form" enctype="multipart/form-data">
			<p><label>Images</label><input type="file" multiple="multiple" name="feaute_image[]" /></p>
			<p><label>CSV file</label> <input type="file" name="csv_post" /></p>
			<p><label>Category</label> <?php wp_dropdown_categories('name=csv_cat&hide_empty=0'); ?> </p>
			<input type="hidden" name="uploading" value="1"/>
		
			
			<p><input type="submit" class="button button-primary button-large" Value="Upload" /></p>
		</form>

		</div>

