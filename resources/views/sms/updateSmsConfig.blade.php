<form action="{{route('sms.updateConfig')}}" method="post">
    {{csrf_field()}}
    <input id="smsId" type="hidden" required name="smsId" value="{{$smsConfig->id}}">


    <div class="form-group">

        <label for="">User Name<span style="color: red">*</span></label>

        <input class="form-control" maxlength="255" value="{{$smsConfig->userName}}" name="useName" required type="text">

    </div>

    <div class="form-group">

        <label for="">Password</label>

        <input class="form-control" name="password" type="password">

    </div>
    <div class="form-group">

        <label for="">Brand Name<span style="color: red">*</span></label>

        <input class="form-control" maxlength="11" value="{{$smsConfig->brandName}}" name="brandName" required type="text">

    </div>
    <div class="form-group">

        <label for="">Rate<span style="color: red">*</span></label>

        <input class="form-control" value="{{$smsConfig->sms_rate}}" maxlength="20" name="sms_rate" required type="text">

    </div>

    <div class="form-group">

        <button type="submit" class="btn btn-success">Submit</button>
    </div>

</form>