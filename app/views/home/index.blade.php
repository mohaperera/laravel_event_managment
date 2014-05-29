@extends('layouts.base')

@section('title')
Profile
@stop

@section('content')
<div class="page-title"> 
	<i class="icon-custom-left"></i>
	<h3>
		<span class="semi-bold">Profile</span>
	</h3>
</div>

<!-- body content -->
<div class="row-fluid">
     <div class="span12">
          <div class="grid simple ">
			<div class="grid-title">
				<h4>Profile <span class="semi-bold">List</span></h4>
				<div class="tools">
					<a href="javascript:;" class="collapse"></a>
					<a href="#grid-config" data-toggle="modal" class="config"></a>
					<a href="javascript:;" class="reload"></a>
					<a href="javascript:;" class="remove"></a>
				</div>
			</div>
            
			<div class="grid-body postion ">
            	Profile view	
			</div>
		</div>
     </div>
</div>
  
  
</div>
</div>
</div>
<!-- END PAGE -->




<div id="sidr" class="sidr right rightSilder">
	<h6> Add New Speakers </h6>

     <div class="row-fluid">
          <div class="span12">
               <div class="grid simple">
                    <div class="grid-body no-border"> <br>
                         <div class="row-fluid">
                              <div class="span12">
                                   <div class="control-group">
								<label class="control-label"> Speaker Name:   <span> * </span> </label>
								<div class="controls">
								  <input type="text" class="span12">
								</div>
							</div>
									
							<div class="control-group">
								<label class="control-label"> Company Name:   <span> * </span> </label>
								<div class="controls">
									<input type="text" class="span12">
								</div>
							</div>
									
									
							<div class="control-group">
								<label class="control-label"> Email:   <span> * </span> </label>
								<div class="controls">
								  <input type="text" class="span12">
								</div>
							</div>
									
									
							<div class="control-group">
								<div class="span6 SideMR">
				  
									<label class="control-label"> Job Title:    <span> * </span> </label>
									<input type="text" class="span12">
                                    
								</div>
							</div>
							
							<div class="control-group">
								<div class="span6">
				   
									<label class="control-label">  Session Title:    <span> * </span> </label>
                                     
									<select>
										<option value="CA">California</option>
										<option value="NV">Nevada</option>
										<option value="OR">Oregon</option>
										<option value="WA">Washington</option>
									</select>
                                    
								</div>
							</div>

							
							<div class="control-group">
								<div class="span6 SideMR">
									<label class="control-label"> Facebook account:<span> * </span> </label>
									<input type="text" class="span12" >
								</div>
							</div>
							
							<div class="control-group">
								<div class="span6">
									<label class="control-label">  Twitter account:<span> * </span> </label>
									<input type="text" class="span12">
								</div>
							</div>
									
							
							<div class="control-group">
								<label class="control-label"> Bio:   <span> * </span> </label>
								<div class="controls">
									<textarea class="span12 " rows="6"> </textarea>
								</div>
							</div>
								 
						</div>
                         </div>
                    </div>
               </div>
          </div>
                    
		<div class="modal-footer">
			<a id="chat-menu-toggle" href="#sidr" class="chat-menu-toggle" >
				<div class="">
					<button class="btn btn-primary btn-cons right"  id="chat-menu-toggle" class="chat-menu-toggle" href="#sidr" type="button">
					    Cancel
					</button>
				<button type="button" class="btn btn-success btn-cons" > Save changes </button>
				</div>
			</a>
		</div>
	</div>
	<!-- END CHAT -->

<script> 
	$(".delete").click(function(event){
		var value=$(event.currentTarget).attr("index");
		$("tr[index='"+value+"']").css("display","none");
	});
</script> 
</body>



@stop
