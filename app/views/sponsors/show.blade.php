@extends('layouts.base')

@section('title')
	Sponsors
@stop

@section('content')
<div class="page-title">
	@include('layouts.success_flash') 
	<i class="icon-custom-left"></i>
	<h3>
		<span class="semi-bold">Sponsor</span>
	</h3>
</div>

  
<!-- body content -->
<div class="row-fluid">
     <div class="span12">
          
        	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped"  width="100%" >
				
					<tr>
						<th>ID  </th>
						<td>{{{ $result->id }}}</td>
					</tr>
					
					<tr>	
						<th> Company Name </th>
						<td>{{{ $result->companyName }}}</td>
					</tr>

					<tr>
						<th> Compnay Logo  </th>
						<td>{{{ $result->compnayLogo }}}</td>
					</tr>

					<tr>
						<th> Booth Number  </th>
						<td>{{{ $result->boothNumber }}}</td>
					</tr>
						
					<tr>
						<th> Sponsorship Category  </th>
						<td>{{{ $result->sponsorshipcategory }}}</td>
					</tr>

					<tr>
						<th> Category  </th>
						<td>{{{ $result->category }}}</td>
					</tr>
					
					<tr>
						<th> Website  </th>
						<td>{{{ $result->website }}}</td>
					</tr>
					
					<tr>
						<th> Product Name  </th>
						<td>{{{ $result->productsName }}}</td>
					</tr>
					
					<tr>
						<th> Image  </th>
						<td>
							<?php
								$realPath = URL::to('uploads/events/dummy.png');
					        	if (!empty($result->image_path) && !empty($result->image)) {        		
					        		$realPath = URL::to($result->image_path."/".$result->image);        		
					        	}
					        	?>	
					          	<img  width="80" src="{{ $realPath }}" alt="event" />

						</td>
					</tr>
					
					<tr>
						<th> Product Description	</th>
						<td>{{{ $result->productDescription }}}</td>
					</tr>
				
			</table>
			</div>
		</div>
     </div>
</div>
  
  
</div>
</div>
</div>
<!-- END PAGE -->

@stop
