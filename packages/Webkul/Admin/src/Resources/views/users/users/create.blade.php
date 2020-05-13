@extends('admin::layouts.content')

@section('page_title')
    {{ __('admin::app.users.users.add-user-title') }}
@stop
<style type="text/css">
    <style>
body{width:610px;}
#frmCheckPassword {border-top:#F0F0F0 2px solid;background:#FAF8F8;padding:10px;}
.demoInputBox{padding:7px; border:#F0F0F0 1px solid; border-radius:4px;}
#password-strength-status {padding: 5px 10px;color: #FFFFFF; border-radius:4px;margin-top:5px;}
.medium-password{background-color: #E4DB11;border:#BBB418 1px solid;}
.weak-password{background-color: #FF6600;border:#AA4502 1px solid;}
.strong-password{background-color: #12CC1A;border:#0FA015 1px solid;}
</style>
</style>

@section('content')
    <div class="content">
        <form method="POST" action="{{ route('admin.users.store') }}" @submit.prevent="onSubmit">
            <div class="page-header">
                <div class="page-title">
                    <h1>
                        <i class="icon angle-left-icon back-link" onclick="history.length > 1 ? history.go(-1) : window.location = '{{ url('/admin/dashboard') }}';"></i>

                        {{ __('admin::app.users.users.add-user-title') }}
                    </h1>
                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        {{ __('admin::app.users.users.save-btn-title') }}
                    </button>
                </div>
            </div>

            <div class="page-content">
                <div class="form-container">
                    @csrf()

                    <accordian :title="'{{ __('admin::app.users.users.general') }}'" :active="true">
                        <div slot="body">
                            <div class="control-group" :class="[errors.has('name') ? 'has-error' : '']">
                                <label for="name" class="required">{{ __('admin::app.users.users.name') }}</label>
                                <input type="text" v-validate="'required'" class="control" id="name" name="name" data-vv-as="&quot;{{ __('admin::app.users.users.name') }}&quot;"/>
                                <span class="control-error" v-if="errors.has('name')">@{{ errors.first('name') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('email') ? 'has-error' : '']">
                                <label for="email" class="required">{{ __('admin::app.users.users.email') }}</label>
                                <input type="text" v-validate="'required|email'" class="control" id="email" name="email" data-vv-as="&quot;{{ __('admin::app.users.users.email') }}&quot;"/>
                                <span class="control-error" v-if="errors.has('email')">@{{ errors.first('email') }}</span>
                            </div>
                        </div>
                    </accordian>

                    <accordian :title="'{{ __('Password') }}'" :active="true">
                        <div slot="body">
                            <div class="control-group" :class="[errors.has('password') ? 'has-error' : '']">
                                <label for="password">{{ __('admin::app.users.users.password') }}</label>
                                <input type="password" v-validate="'min:6|max:18'" class="control" id="password" onKeyUp="checkPasswordStrength();" name="password" ref="password" data-vv-as="&quot;{{ __('admin::app.users.users.password') }}&quot;"/>
                                <div id='password-strength-status'></div>
                            </div>

                            <div class="control-group" :class="[errors.has('password_confirmation') ? 'has-error' : '']">
                                <label for="password_confirmation">{{ __('admin::app.users.users.confirm-password') }}</label>
                                <input type="password" v-validate="'min:6|max:18|confirmed:password'" class="control" id="password_confirmation" name="password_confirmation" data-vv-as="&quot;{{ __('admin::app.users.users.confirm-password') }}&quot;"/>
                                <span class="control-error" v-if="errors.has('password_confirmation')">@{{ errors.first('password_confirmation') }}</span>
                            </div>
                        </div>
                    </accordian>

                    <accordian :title="'{{ __('admin::app.users.users.status-and-role') }}'" :active="true">
                        <div slot="body">
                            <div class="control-group" :class="[errors.has('role_id') ? 'has-error' : '']">
                                <label for="role" class="required">{{ __('admin::app.users.users.role') }}</label>
                                <select v-validate="'required'" class="control" name="role_id" data-vv-as="&quot;{{ __('admin::app.users.users.role') }}&quot;">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                <span class="control-error" v-if="errors.has('role_id')">@{{ errors.first('role_id') }}</span>
                            </div>

                            <div class="control-group">
                                <label for="status">{{ __('admin::app.users.users.status') }}</label>
                               
                                <label class="switch">
                                    <input type="checkbox" id="status" name="status" value="1" {{ old('status') ? 'checked' : '' }}>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </accordian>
                </div>
            </div>
        </form>
    </div>
@stop

<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
    function checkPasswordStrength() {
var number = /([0-9])/;
var alphabets = /([a-zA-Z])/;
var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
if($('#password').val().length<6) {
    $('#password-strength-status').removeClass();
    $('#password-strength-status').addClass('weak-password');
    $('#password-strength-status').html("Weak (should be atleast 6 characters.)");
} 
else {    
    if($('#password').val().match(number) && $('#password').val().match(alphabets) && $('#password').val().match(special_characters)) {            
        $('#password-strength-status').removeClass();
        $('#password-strength-status').addClass('strong-password');
        $('#password-strength-status').html("Strong");
    } 
    else {
        $('#password-strength-status').removeClass();
        $('#password-strength-status').addClass('medium-password');
        $('#password-strength-status').html("Medium (should include alphabets, numbers and special characters.)");
    }
}
}
</script>