@extends('layout.mainLayout')

@section('content')
<div class="row">
    <div class="container-fluid">
        <div class="panel">
                <form action="{{route('employee.store')}}" method="post" id="registrationForm" class="form-horizontal bv-form" novalidate="novalidate" >
                    {{csrf_field()}}
                    <button type="submit" class="bv-hidden-submit" style="display: none; width: 0px; height: 0px;" disabled="disabled"></button>
                    <div class="panel-body">
                        <div class="row ">
                            <div class="form-group ">
                                <label class="col-xs-3 control-label">Employee name</label>
                                <div class="col-xs-5">
                                    <input type="text" class="form-control" name="employeeName" placeholder="Employee name" data-bv-field="employeeName">
                                    <small class="help-block" data-bv-validator="notEmpty" data-bv-for="employeeName" data-bv-result="INVALID" style="">The employeeName name is required</small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group ">
                                    <label class="col-xs-3 control-label">Designation</label>
                                    <div class="col-xs-5">
                                        <input type="text" class="form-control" name="degisnation" data-bv-field="degisnation">
                                        <small class="help-block" data-bv-validator="notEmpty" data-bv-for="degisnation" data-bv-result="INVALID" style="">The Designation is required</small>
                                        <small class="help-block" data-bv-validator="stringLength" data-bv-for="username" data-bv-result="VALID" style="display: none;">The username must be more than 6 and less than 30 characters long</small>
                                        <small class="help-block" data-bv-validator="regexp" data-bv-for="username" data-bv-result="VALID" style="display: none;">The username can only consist of alphabetical, number, dot and underscore</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group ">
                                    <label class="col-xs-3 control-label">Salary</label>
                                    <div class="col-xs-5">
                                        <input type="text" class="form-control" name="salary" data-bv-field="salary">
                                        <small class="help-block" data-bv-validator="notEmpty" data-bv-for="salary" data-bv-result="INVALID" style="">The Salary address is required</small>
                                        <small class="help-block" data-bv-validator="emailAddress" data-bv-for="email" data-bv-result="VALID" style="display: none;">The input is not a valid email address</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group ">
                                    <label class="col-xs-3 control-label">Email</label>
                                    <div class="col-xs-5">
                                        <input type="email" class="form-control" name="email" data-bv-field="email">
                                        <small class="help-block" data-bv-validator="notEmpty" data-bv-for="email" data-bv-result="INVALID" style="">The email is required</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group ">
                                    <label class="col-xs-3 control-label">Phone</label>
                                    <div class="col-xs-5">
                                        <input type="text" class="form-control" name="phone" data-bv-field="phone">
                                        <small class="help-block" data-bv-validator="notEmpty" data-bv-for="phone" data-bv-result="INVALID" style="">The Phone is required</small>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="form-group ">
                                    <label class="col-xs-3 control-label">Address</label>
                                    <div class="col-xs-5">
                                        <input type="text" class="form-control" name="address" data-bv-field="address">
                                        <small class="help-block" data-bv-validator="notEmpty" data-bv-for="address" data-bv-result="INVALID" style="">The address is required</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group ">
                                    <div class="col-xs-6 col-xs-offset-3">
                                        <div class="checkbox">
                                            <label class="form-checkbox form-icon form-text">
                                                <input type="checkbox" name="agree" value="agree" data-bv-field="agree">
                                                Agree with the terms and conditions
                                            </label>
                                        </div>
                                        <small class="help-block" data-bv-validator="notEmpty" data-bv-for="agree" data-bv-result="INVALID" style="">You must agree with the terms and conditions</small></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-xs-9 col-xs-offset-3">
                                        <button type="submit" class="btn btn-primary" name="signup" value="Sign up" disabled="disabled">
                                            Submit
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection
@section('foot-js')
    <script src="{{url('public/js/demo/form-validation.js')}}"></script>
@endsection