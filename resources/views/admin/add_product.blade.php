@extends('adminLayout')
@section('admin_content')
<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="index.html">Home</a>
					<i class="icon-angle-right"></i> 
				</li>
				<li>
					<i class="icon-edit"></i>
					<a href="#">Forms</a>
				</li>
			</ul>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Form Elements</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<p class="alert-success">
						<?php 
							$message=Session::get('message');
							if($message){
								 echo $message;
								 session::put('message',null);
							}
						?>
					</p>
					<div class="box-content">
						<form class="form-horizontal" action="{{url('/save_product')}}" method="post" enctype="multipart/form-data">
							{{csrf_field()}}
						  <fieldset>
							<div class="control-group">
							  <label class="control-label" for="date01">Product Name</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" id="date01" name="product_name">
							  </div>
							</div>  
							<div class="control-group">
							  <label class="control-label" for="fileInput">Image</label>
							  <div class="controls">
								<input class="input-file uniform_on" name="product_image" id="fileInput" type="file">
							  </div>
							</div> 
							<div class="control-group">
							  <label class="control-label" for="date01">Product color</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" id="date01" name="product_color">
							  </div>
							</div> 
							<div class="control-group">
							  <label class="control-label" for="date01">Product size</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" id="date01" name="product_size">
							  </div>
							</div> 
							<div class="control-group">
							  <label class="control-label" for="date01">Product price</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" id="date01" name="product_price">
							  </div>
							</div>   
							<div class="control-group">
								<label class="control-label" for="selectError3">product category</label>
								<div class="controls">
								  <select id="selectError3" name="category_id">
								  	<?php 
                                	$show_category=DB::table('tbl_category')
                                              ->where('publication_status',1)
                                              ->get();
                             		?>
                             		<option>Select category</option>
                             		@foreach($show_category as $v_category)
									<option value="{{$v_category->category_id}}">{{$v_category->category_name}}</option>
									@endforeach
								  </select>
								</div>
							  </div>  
							  <div class="control-group">
								<label class="control-label" for="selectError3">manufacture name</label>
								<div class="controls">
								  <select id="selectError3" name="manufacture_id">
								  	<?php 
                                	$manufacture_name=DB::table('manufacture')
                                              ->where('publication_status',1)
                                              ->get();
                             		?>
									<option>Select</option>
									@foreach($manufacture_name as $v_manufacture)
									<option value="{{$v_manufacture->manufacture_id}}">{{$v_manufacture->manufacture_name}}</option>
									@endforeach
								  </select>
								</div>
							  </div>       
							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">product short description</label>
							  <div class="controls">
								<textarea class="cleditor" id="textarea2" rows="3" name="product_short_description"></textarea>
							  </div>
							</div>
							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">product short description</label>
							  <div class="controls">
								<textarea class="cleditor" id="textarea2" rows="3" name="product_long_description"></textarea>
							  </div>
							</div>
							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">Publication status</label>
							  <div class="controls">
								<input type="checkbox" class="input-xlarge" id="date01" name="publication_status" value="1">
							  </div>
							</div>
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Save changes</button>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->
@endsection()