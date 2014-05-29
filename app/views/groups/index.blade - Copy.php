@extends('layouts.base')

@section('title')
Group
@stop

@section('content')
<div class="page-title"> 
	<i class="icon-custom-left"></i>
	<h3>
		<span class="semi-bold">Groups</span>
	</h3>
</div>

<!-- Search -->
<div class="row-fluid">
     <div class="span12">
          <div class="grid simple">
                
			<div class="grid-title no-border">
				<h4>Search  <span class="semi-bold">Filter</span></h4>
				<div class="tools"> <a class="collapse" href="javascript:;"></a> 
					<a class="config" data-toggle="modal" href="#grid-config"></a> <a class="reload" href="javascript:;">
					</a>
					<a class="remove" href="javascript:;"></a>
				</div>
			</div>
			 
               <div class="grid-body no-border segmentationPD">
				<div class="row-fluid">
					<div class="span3">		
						<select class="AGcolor" id="source">
						<optgroup label="Age">
						<option value="AK">Age</option>
						<option value="AK">10-15</option>
						<option value="HI">15-20</option>
						</optgroup>
						
						<optgroup label="Age">
						<option value="AK">20-25</option>
						<option value="HI">25-30</option>
						</optgroup>
						</select>
					</div>   
					<div class="span2">		
						<select id="source" class="smallselect">
							<optgroup label="equal">
							<option value="HI">is between</option>
							<option value="AK">equal </option>
							<option value="HI">less than</option>
						    
						</select>
					</div>   
					<div class="span2">		
						<input class="input-small" placeholder="20" type="text">
					</div> 
					<div class="span1">		
						<a class="btn disabled" href="#"> And </a>  
					</div> 
					<div class="span2">		
						<input class="input-small" placeholder="25" type="text">
					</div> 
				</div>
               </div>
           
           
               <div class="grid-body no-border segmentationPD"> 
				<div class="row-fluid">
					<div class="span3">		
						<select  class="AGcolor" id="source">
							<optgroup label="Gender">
							<option value="AK">Gender</option>
							<option value="AK">Male</option>
							<option value="HI">Fmale</option>
						</select>
					</div>   
                  
					<div class="span2">		
						<select id="source">
							<optgroup label="Gender">
							<option value="AK">Gender</option>
							<option value="AK">Male</option>
							<option value="HI">Fmale</option>
						</select>
					</div> 
				</div>
               </div>
          </div>
     </div>
</div>
<!-- //Search -->


<div class="span12">
	<div class="grid-body addPD">
		<div class="row-fluid">
			<a id="chat-menu-toggle" href="#sidr" class="chat-menu-toggle" >
				<div class="">
					<button class="btn btn-primary btn-cons right"  id="chat-menu-toggle" class="chat-menu-toggle" href="#sidr" type="button">
						<i class="icon-plus"></i>
							Add New Group
					</button>
				</div>
			</a>
		</div>
	</div>
       
</div>
  
<!-- body content -->
<div class="row-fluid">
     <div class="span12">
          <div class="grid simple ">
			<div class="grid-title">
				<h4>Attendee <span class="semi-bold">List</span></h4>
				<div class="tools">
					<a href="javascript:;" class="collapse"></a>
					<a href="#grid-config" data-toggle="modal" class="config"></a>
					<a href="javascript:;" class="reload"></a>
					<a href="javascript:;" class="remove"></a>
				</div>
			</div>
            
			<div class="grid-body postion ">
            
			<div class="download-icon">
				<ul class="nav quick-section ">
					<li class="quicklinks Seticon"> <a data-toggle="dropdown" class="dropdown-toggle  pull-right" href="#"> <i class="icon-cloud-download"></i> </a>
						<ul class="dropdown-menu  pull-right setUl" role="menu" aria-labelledby="dropdownMenu">
							<li><a href="/"> CSV </a> </li>
							<li><a href="/">Excel</a> </li>
							<li><a href="/"> PDF </a> </li>
							<li><a href="/"> Copy </a> </li>
						</ul>
					</li>
					<li class="quicklinks"> <span class="h-seperate"></span></li>
				</ul>
			</div>
              
			<table cellpadding="0" cellspacing="0" border="0" class="table table-striped" id="example2" width="100%" >
				<thead>
					<tr>
						<th>ID  </th>
						<th> Title </th>
						<th> Description  </th>
						<th> Action </th>
					</tr>
				</thead>
				
				<tbody>
				
				@if(!empty($results))
					@foreach ($results as $result) 
						<tr class="odd gradeX">
							<td>{{{ $result->id }}}</td>
							<td>{{{ $result->title }}}</td>
							<td>{{{ $result->description }}}</td>
							<td class="center">
								
								<a class="icon-plus-sign-alt"></a>
								&nbsp;
								<a class="icon-trash"></a>
							</td>
						</tr>
					@endforeach
				@endif 
               	</tbody>
			</table>
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
