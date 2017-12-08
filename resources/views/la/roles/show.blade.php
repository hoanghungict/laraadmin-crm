@extends('la.layouts.app')

@section('htmlheader_title')
	Role View
@endsection

@section('main-content')
<div id="page-content" class="profile2">
	<div class="bg-primary clearfix">
		<div class="col-md-4">
			<div class="row">
				<div class="col-md-3">
					<div class="profile-icon text-primary"><i class="fa {{ $module->fa_icon }}"></i></div>
				</div>
				<div class="col-md-9">
					<h4 class="name">{{ $role->$view_col }}</h4>
					<div class="row stats">
						<div class="col-md-4"><i class="fa fa-facebook"></i> 234</div>
						<div class="col-md-4"><i class="fa fa-twitter"></i> 12</div>
						<div class="col-md-4"><i class="fa fa-instagram"></i> 89</div>
					</div>
					<p class="desc">Test Description in one line</p>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="dats1"><div class="label2">Admin</div></div>
			<div class="dats1"><i class="fa fa-envelope-o"></i> superadmin@gmail.com</div>
			<div class="dats1"><i class="fa fa-map-marker"></i> Pune, India</div>
		</div>
		<div class="col-md-4">

			<div class="dats1 pb">
				<div class="clearfix">
					<span class="pull-left">Task #1</span>
					<small class="pull-right">20%</small>
				</div>
				<div class="progress progress-xs active">
					<div class="progress-bar progress-bar-warning progress-bar-striped" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
						<span class="sr-only">20% Complete</span>
					</div>
				</div>
			</div>
			<div class="dats1 pb">
				<div class="clearfix">
					<span class="pull-left">Task #2</span>
					<small class="pull-right">90%</small>
				</div>
				<div class="progress progress-xs active">
					<div class="progress-bar progress-bar-warning progress-bar-striped" style="width: 90%" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100">
						<span class="sr-only">90% Complete</span>
					</div>
				</div>
			</div>
			<div class="dats1 pb">
				<div class="clearfix">
					<span class="pull-left">Task #3</span>
					<small class="pull-right">60%</small>
				</div>
				<div class="progress progress-xs active">
					<div class="progress-bar progress-bar-warning progress-bar-striped" style="width: 60%" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">
						<span class="sr-only">60% Complete</span>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-1 actions">
			@la_access("Roles", "edit")
				<a href="{{ url(config('laraadmin.adminRoute') . '/roles/'.$role->id.'/edit') }}" class="btn btn-xs btn-edit btn-default"><i class="fa fa-pencil"></i></a><br>
			@endla_access

			@la_access("Roles", "delete")
				{{ Form::open(['route' => [config('laraadmin.adminRoute') . '.roles.destroy', $role->id], 'method' => 'delete', 'style'=>'display:inline']) }}
					<button class="btn btn-default btn-delete btn-xs" type="submit"><i class="fa fa-times"></i></button>
				{{ Form::close() }}
			@endla_access
		</div>
	</div>

	<ul data-toggle="ajax-tab" class="nav nav-tabs profile" role="tablist">
		<li class=""><a href="{{ url(config('laraadmin.adminRoute') . '/roles') }}" data-toggle="tooltip" data-placement="right" title="Back to Roles"><i class="fa fa-chevron-left"></i></a></li>
		<li class="active"><a role="tab" data-toggle="tab" class="active" href="#tab-general-info" data-target="#tab-info"><i class="fa fa-bars"></i> General Info</a></li>
		@role("SUPER_ADMIN")
		<li class=""><a role="tab" data-toggle="tab" href="#tab-access" data-target="#tab-access"><i class="fa fa-key"></i> Access</a></li>
		@endrole
	</ul>

	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active fade in" id="tab-info">
			<div class="tab-content">
				<div class="panel infolist">
					<div class="panel-default panel-heading">
						<h4>General Info</h4>
					</div>
					<div class="panel-body">
						@la_display($module, 'name')
						@la_display($module, 'display_name')
						@la_display($module, 'description')
						@la_display($module, 'parent')
						@la_display($module, 'dept')
					</div>
				</div>
			</div>
		</div>
		@role("SUPER_ADMIN")
		<div role="tabpanel" class="tab-pane fade in p20 bg-white" id="tab-access">
			<div class="guide1">
				<span class="pull-left">Module Accesses for {{ $role->display_name }} Role</span>
				<i class="fa fa-circle gray"></i> Invisible <i class="fa fa-circle orange"></i> Read-Only <i class="fa fa-circle green"></i> Write
			</div>
			<form action="{{ url(config('laraadmin.adminRoute') . '/save_module_role_permissions/'.$role->id) }}" method="post">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<table class="table table-bordered dataTable no-footer table-access">
					<thead>
						<tr class="blockHeader">
							<th width="30%">
								<input class="alignTop" type="checkbox" id="module_select_all" id="module_select_all" checked="checked">&nbsp; Modules
							</th>
							<th width="14%">
								<input type="checkbox" id="view_all" checked="checked">&nbsp; View
							</th>
							<th width="14%">
								<input type="checkbox" id="create_all" checked="checked">&nbsp; Create
							</th>
							<th width="14%">
								<input type="checkbox" id="edit_all" checked="checked">&nbsp; Edit
							</th>
							<th width="14%">
							<input class="alignTop" id="delete_all" type="checkbox"  checked="checked">&nbsp; Delete
							</th>
							<th width="14%">Field Privileges</th>
						</tr>
					</thead>
					@foreach($modules_access as $module)
						<tr>
							<td><input module_id="{{ $module->id }}" class="module_checkb" type="checkbox" name="module_{{$module->id}}" id="module_{{$module->id}}" checked="checked">&nbsp; {{ $module->name }}</td>
							<td><input module_id="{{ $module->id }}" class="view_checkb" type="checkbox" name="module_view_{{$module->id}}" id="module_view_{{$module->id}}" <?php if($module->accesses->view == 1) { echo 'checked="checked"'; } ?> ></td>
							<td><input module_id="{{ $module->id }}" class="create_checkb" type="checkbox" name="module_create_{{$module->id}}" id="module_create_{{$module->id}}" <?php if($module->accesses->create == 1) { echo 'checked="checked"'; } ?> ></td>
							<td><input module_id="{{ $module->id }}" class="edit_checkb" type="checkbox" name="module_edit_{{$module->id}}" id="module_edit_{{$module->id}}" <?php if($module->accesses->edit == 1) { echo 'checked="checked"'; } ?> ></td>
							<td><input module_id="{{ $module->id }}" class="delete_checkb" type="checkbox" name="module_delete_{{$module->id}}" id="module_delete_{{$module->id}}" <?php if($module->accesses->delete == 1) { echo 'checked="checked"'; } ?> ></td>
							<td>
								<a module_id="{{ $module->id }}" class="toggle-adv-access btn btn-default btn-sm hide_row"><i class="fa fa-chevron-down"></i></a>
							</td>
						</tr>
						<tr class="tr-access-adv module_fields_{{ $module->id }} hide" module_id="{{ $module->id }}" >
							<td colspan=6>
								<table class="table table-bordered">
								@foreach (array_chunk($module->accesses->fields, 3, true) as $fields)
									<tr>
										@foreach ($fields as $field)
											<td><div class="col-md-3"><input type="text" name="{{ $field['colname'] }}_{{ $module->id }}_{{ $role->id }}" value="{{ $field['access'] }}" data-slider-value="{{ $field['access'] }}" class="slider form-control" data-slider-min="0" data-slider-max="2" data-slider-step="1" data-slider-orientation="horizontal"  data-slider-id="{{ $field['colname'] }}_{{ $module->id }}_{{ $role->id }}"></div> {{ $field['label'] }} </td>
										@endforeach
									</tr>
								@endforeach
								</table>
							</td>
						</tr>
					@endforeach
				</table>
				<center><input class="btn btn-success" type="submit" name="Save"></center>
			</form>
		</div>
		@endrole
	</div>
	</div>
	</div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('la-assets/plugins/datatables/datatables.min.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('la-assets/plugins/bootstrap-slider/slider.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('la-assets/plugins/bootstrap-slider/slider-handle.css') }}"/>
@endpush

@push('scripts')
<script src="{{ asset('la-assets/plugins/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('la-assets/plugins/bootstrap-slider/bootstrap-slider.js') }}"></script>
<script src="{{ asset('la-assets/plugins/bootstrap-slider/bootstrap-slider-handle.js') }}"></script>
@endpush
