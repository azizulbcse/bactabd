@extends('adminlte::page')

@section('title', 'My Profile | BACTA')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center animate__animated animate__fadeIn">
        <h1 style="color: #00496A; font-weight: 700; font-family: 'Poppins', sans-serif;">
            <i class="fas fa-user-circle mr-2" style="color: #00ADEF;"></i> My Profile
        </h1>
        <ol class="breadcrumb float-sm-right small text-muted d-none d-sm-flex">
            <li class="breadcrumb-item active">My Profile</li>
        </ol>
    </div>
@stop

@section('content')
<div class="container-fluid animate__animated animate__fadeInUp" style="font-family: 'Poppins', sans-serif;">
    <style>
        .card {
            border-radius: 16px !important;
            box-shadow: 0 20px 45px -10px rgba(15, 23, 42, 0.14) !important;
            border: none !important;
            background: #ffffff !important;
            position: relative;
            overflow: hidden;
        }
        .card::before {
            content: ''; position: absolute; top: 0; left: 0; right: 0; height: 4px;
            background: linear-gradient(90deg, #0284C7 0%, #1E40AF 100%); z-index: 1;
        }
        .card-body { padding: 25px; }

        .form-label { font-weight: 600; color: #444; font-size: 14px; margin-bottom: 8px; display: block; }
        .form-label.required::after { content: " *"; color: #dc3545; }

        .input-group {
            position: relative;
            background-color: #f8f9fa;
            border-radius: 8px;
            border: 1px solid #ddd;
            overflow: hidden;
            transition: 0.3s;
        }
        .input-group:focus-within { border-color: #0284C7; box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.12); }
        .is-invalid-border { border: 1px solid #dc3545 !important; }

        .input-group-text { background: transparent; border: none; color: #0284C7; padding-left: 15px; width: 45px; }
        .form-control { background: transparent; border: none; height: 45px; font-size: 15px; color: #222 !important; width: 100%; }
        .form-control:focus { box-shadow: none; background: transparent; color: #222 !important; outline: none; }

        .password-toggle-box {
            position: absolute; right: 15px; top: 13px; z-index: 10;
            color: #a0aec0; cursor: pointer; font-size: 15px; transition: 0.2s;
        }
        .password-toggle-box:hover { color: #0284C7; }

        @keyframes cgShake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-5px); }
            40%, 80% { transform: translateX(5px); }
        }
        .field-shake { animation: cgShake 0.4s ease-in-out; }
        .live-error-msg { display: none; color: #dc3545; font-size: 11.5px; font-weight: 700; margin-top: 6px; align-items: center; gap: 5px; }
        .live-ok-msg { display: none; color: #10B981; font-size: 11.5px; font-weight: 700; margin-top: 6px; align-items: center; gap: 5px; }

        .strength-bar-track { height: 5px; border-radius: 4px; background: #E2E8F0; margin-top: 8px; overflow: hidden; }
        .strength-bar-fill { height: 100%; width: 0%; border-radius: 4px; transition: width 0.25s ease, background-color 0.25s ease; }
        .strength-label { font-size: 11px; font-weight: 700; margin-top: 4px; display: block; }

        .btn-login {
            background: linear-gradient(135deg, #0284C7 0%, #1E40AF 100%) !important;
            border: none; color: white !important; height: 48px; border-radius: 8px;
            font-weight: 600; transition: 0.3s; font-size: 16px; letter-spacing: 0.5px;
            box-shadow: 0 8px 20px rgba(2, 132, 199, 0.25) !important;
        }
        .btn-login:hover { filter: brightness(1.05); box-shadow: 0 10px 24px rgba(2, 132, 199, 0.35) !important; }
        .btn-login:disabled { opacity: 0.75; }

        .profile-tabs.nav-tabs { border-bottom: 2px solid #E2E8F0; padding: 0 20px; }
        .profile-tabs.nav-tabs .nav-link {
            border: none; color: #64748B; font-weight: 600; font-size: 13.5px;
            padding: 14px 18px; border-radius: 0;
        }
        .profile-tabs.nav-tabs .nav-link.active {
            color: #0284C7; border-bottom: 3px solid #0284C7; background: transparent;
        }

        .avatar-dropzone {
            width: 96px; height: 96px; border-radius: 50%; border: 2px dashed #CBD5E1;
            display: flex; align-items: center; justify-content: center; position: relative;
            cursor: pointer; overflow: hidden; transition: all 0.2s ease; background: #F8FAFC; flex-shrink: 0;
        }
        .avatar-dropzone:hover { border-color: #0284C7; }
        .avatar-dropzone img { width: 100%; height: 100%; object-fit: cover; }
        .avatar-dropzone .avatar-overlay {
            position: absolute; inset: 0; background: rgba(15,23,42,0.55); color: #fff;
            display: flex; align-items: center; justify-content: center; opacity: 0; transition: opacity 0.2s ease; font-size: 18px;
        }
        .avatar-dropzone:hover .avatar-overlay { opacity: 1; }
    </style>

    <div class="row">
        <div class="col-md-9 mx-auto">
            <div class="card shadow-lg mt-3">
                <ul class="nav nav-tabs profile-tabs" id="profileTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="info-tab" data-toggle="tab" href="#infoTabPane" role="tab">
                            <i class="fas fa-id-card mr-1"></i> Profile Info
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="security-tab" data-toggle="tab" href="#securityTabPane" role="tab">
                            <i class="fas fa-key mr-1"></i> Change Password
                        </a>
                    </li>
                </ul>

                <div class="tab-content">
                    {{-- ============= PROFILE INFO TAB ============= --}}
                    <div class="tab-pane fade show active" id="infoTabPane" role="tabpanel">
                        <div class="card-body">
                            <form action="{{ route('profile.update') }}" method="post" id="profileInfoForm" enctype="multipart/form-data" novalidate>
                                @csrf
                                @method('patch')

                                <div class="d-flex align-items-center mb-4">
                                    <div class="avatar-dropzone mr-4" id="avatarDropzone">
                                        @if($user->profile_pic)
                                            <img src="{{ asset($user->profile_pic) }}" id="avatarPreview" alt="{{ $user->name }}">
                                        @else
                                            <i class="fas fa-user text-muted" style="font-size: 34px;" id="avatarPlaceholderIcon"></i>
                                            <img src="" id="avatarPreview" alt="{{ $user->name }}" style="display:none;">
                                        @endif
                                        <div class="avatar-overlay"><i class="fas fa-camera"></i></div>
                                    </div>
                                    <div>
                                        <div class="font-weight-bold" style="color:#0F172A; font-size: 15px;">{{ $user->name }}</div>
                                        <div class="text-muted small">{{ $user->email }}</div>
                                        <div class="text-muted small mt-1"><i class="fas fa-circle-info mr-1"></i> Click the circle to change your photo (JPG/PNG/WEBP, max 2MB)</div>
                                    </div>
                                    <input type="file" name="profile_pic" id="avatarInput" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp" style="display:none;">
                                </div>

                                <div class="row">
                                    <div class="col-md-6 form-group mb-4">
                                        <label class="form-label required">Full Name</label>
                                        <div class="input-group" id="nameGroup">
                                            <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-user"></i></span></div>
                                            <input type="text" name="name" id="nameField" class="form-control" value="{{ old('name', $user->name) }}" required>
                                        </div>
                                        <small id="nameLiveError" class="live-error-msg"><i class="fas fa-exclamation-circle"></i> <span>Name is required.</span></small>
                                        @error('name')
                                            <small class="text-danger font-weight-bold mt-1 d-block"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group mb-4">
                                        <label class="form-label required">Email Address</label>
                                        <div class="input-group" id="emailGroup">
                                            <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-envelope"></i></span></div>
                                            <input type="email" name="email" id="emailField" class="form-control" value="{{ old('email', $user->email) }}" required>
                                        </div>
                                        <small id="emailLiveError" class="live-error-msg"><i class="fas fa-exclamation-circle"></i> <span>Enter a valid email address.</span></small>
                                        @error('email')
                                            <small class="text-danger font-weight-bold mt-1 d-block"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 form-group mb-4">
                                        <label class="form-label">Mobile Number</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-phone"></i></span></div>
                                            <input type="text" name="mobile_no" class="form-control" value="{{ old('mobile_no', $user->mobile_no) }}" placeholder="e.g., 01712345678">
                                        </div>
                                    </div>
                                    <div class="col-md-6 form-group mb-4">
                                        <label class="form-label">Designation</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-user-md"></i></span></div>
                                            <input type="text" name="designation" class="form-control" value="{{ old('designation', $user->designation) }}" placeholder="e.g., Cardiac Anesthesiologist">
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-2 mb-2">
                                    <button type="submit" class="btn btn-primary btn-block btn-login shadow-sm" id="infoSubmitBtn">
                                        <i class="fas fa-save mr-2" id="infoBtnIcon"></i>
                                        <span id="infoBtnText">SAVE PROFILE</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- ============= CHANGE PASSWORD TAB ============= --}}
                    <div class="tab-pane fade" id="securityTabPane" role="tabpanel">
                        <div class="card-body">
                            <p class="text-muted small mb-4">Ensure your account is using a long, random password to stay secure.</p>

                            <form action="{{ route('password.update') }}" method="post" id="passwordChangeForm" novalidate>
                                @csrf
                                @method('put')

                                <div class="form-group mb-4">
                                    <label class="form-label required">Current Password [বর্তমান পাসওয়ার্ড]</label>
                                    <div class="input-group @error('current_password', 'updatePassword') is-invalid-border @enderror" id="currentGroup" style="position: relative;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                                        </div>
                                        <input type="password" name="current_password" id="currentPasswordField" class="form-control" placeholder="••••••••" required>
                                        <span class="password-toggle-box" id="toggleCurrentPasswordBtn">
                                            <i class="fas fa-eye" id="currentEyeIcon"></i>
                                        </span>
                                    </div>
                                    <small id="currentLiveError" class="live-error-msg">
                                        <i class="fas fa-exclamation-circle"></i> <span>Please enter your current password.</span>
                                    </small>
                                    @error('current_password', 'updatePassword')
                                        <small class="text-danger font-weight-bold mt-1 d-block">
                                            <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group mb-4">
                                        <label class="form-label required">New Password [নতুন পাসওয়ার্ড]</label>
                                        <div class="input-group @error('password', 'updatePassword') is-invalid-border @enderror" id="newGroup" style="position: relative;">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                            </div>
                                            <input type="password" name="password" id="newPasswordField" class="form-control" placeholder="••••••••" required>
                                            <span class="password-toggle-box" id="toggleNewPasswordBtn">
                                                <i class="fas fa-eye" id="newEyeIcon"></i>
                                            </span>
                                        </div>
                                        <div class="strength-bar-track"><div class="strength-bar-fill" id="strengthBarFill"></div></div>
                                        <span class="strength-label" id="strengthLabel"></span>
                                        <small id="newLiveError" class="live-error-msg">
                                            <i class="fas fa-exclamation-circle"></i> <span>Password must be at least 8 characters.</span>
                                        </small>
                                        @error('password', 'updatePassword')
                                            <small class="text-danger font-weight-bold mt-1 d-block">
                                                <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                                            </small>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group mb-4">
                                        <label class="form-label required">Confirm New Password [পাসওয়ার্ড নিশ্চিত করুন]</label>
                                        <div class="input-group" id="confirmGroup" style="position: relative;">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                            </div>
                                            <input type="password" name="password_confirmation" id="confirmPasswordField" class="form-control" placeholder="••••••••" required>
                                            <span class="password-toggle-box" id="toggleConfirmPasswordBtn">
                                                <i class="fas fa-eye" id="confirmEyeIcon"></i>
                                            </span>
                                        </div>
                                        <small id="confirmLiveError" class="live-error-msg">
                                            <i class="fas fa-exclamation-circle"></i> <span>Passwords do not match.</span>
                                        </small>
                                        <small id="confirmLiveOk" class="live-ok-msg">
                                            <i class="fas fa-check-circle"></i> <span>Passwords match.</span>
                                        </small>
                                    </div>
                                </div>

                                <div class="mt-2 mb-2">
                                    <button type="submit" class="btn btn-primary btn-block btn-login shadow-sm" id="btnSubmit">
                                        <i class="fas fa-save mr-2" id="btnIcon"></i>
                                        <span id="btnText">SAVE NEW PASSWORD</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('js')
<script>
    $(document).ready(function() {
        // ট্যাব ডিপ লিংক: এরর/স্ট্যাটাস অনুযায়ী সঠিক ট্যাব খুলে দেবে
        @if($errors->updatePassword->any() || session('status') === 'password-updated')
            $('#security-tab').tab('show');
        @endif

        // ============= প্রোফাইল ছবি ড্র্যাগ-ড্রপ প্রিভিউ =============
        $('#avatarDropzone').on('click', function () { $('#avatarInput').click(); });
        $('#avatarInput').on('change', function (e) {
            if (e.target.files && e.target.files[0]) {
                const reader = new FileReader();
                reader.onload = function (ev) {
                    $('#avatarPreview').attr('src', ev.target.result).show();
                    $('#avatarPlaceholderIcon').hide();
                };
                reader.readAsDataURL(e.target.files[0]);
            }
        });

        // ============= প্রোফাইল ইনফো ফর্ম: স্মার্ট ভ্যালিডেশন =============
        function showFieldError(groupId, errorId) {
            $('#' + groupId).addClass('is-invalid-border field-shake');
            $('#' + errorId).css('display', 'flex');
            setTimeout(function () { $('#' + groupId).removeClass('field-shake'); }, 420);
        }
        function clearFieldError(groupId, errorId) {
            $('#' + groupId).removeClass('is-invalid-border');
            $('#' + errorId).css('display', 'none');
        }

        $('#nameField').on('input', function () { clearFieldError('nameGroup', 'nameLiveError'); });
        $('#emailField').on('input', function () { clearFieldError('emailGroup', 'emailLiveError'); });

        $('#profileInfoForm').on('submit', function (e) {
            const name = $('#nameField').val().trim();
            const email = $('#emailField').val().trim();
            const emailValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
            let isValid = true;

            clearFieldError('nameGroup', 'nameLiveError');
            clearFieldError('emailGroup', 'emailLiveError');

            if (!name) { showFieldError('nameGroup', 'nameLiveError'); isValid = false; }
            if (!emailValid) { showFieldError('emailGroup', 'emailLiveError'); isValid = false; }

            if (!isValid) {
                e.preventDefault();
                return false;
            }

            $('#infoSubmitBtn').attr('disabled', true);
            $('#infoBtnIcon').removeClass('fa-save').addClass('fas fa-spinner fa-spin');
            $('#infoBtnText').text('SAVING...');
        });

        // ============= পাসওয়ার্ড ফর্ম =============
        function togglePasswordField(fieldId, iconId, btnId) {
            $('#' + btnId).on('click', function() {
                const field = $('#' + fieldId);
                const icon = $('#' + iconId);
                if (field.attr('type') === 'password') {
                    field.attr('type', 'text');
                    icon.removeClass('fa-eye').addClass('fa-eye-slash');
                    $(this).css('color', '#0284C7');
                } else {
                    field.attr('type', 'password');
                    icon.removeClass('fa-eye-slash').addClass('fa-eye');
                    $(this).css('color', '#a0aec0');
                }
            });
        }
        togglePasswordField('currentPasswordField', 'currentEyeIcon', 'toggleCurrentPasswordBtn');
        togglePasswordField('newPasswordField', 'newEyeIcon', 'toggleNewPasswordBtn');
        togglePasswordField('confirmPasswordField', 'confirmEyeIcon', 'toggleConfirmPasswordBtn');

        $('#newPasswordField').on('input', function () {
            clearFieldError('newGroup', 'newLiveError');
            const val = $(this).val();
            let score = 0;
            if (val.length >= 8) score++;
            if (val.length >= 12) score++;
            if (/[A-Z]/.test(val) && /[a-z]/.test(val)) score++;
            if (/[0-9]/.test(val) && /[^A-Za-z0-9]/.test(val)) score++;

            const bar = $('#strengthBarFill');
            const label = $('#strengthLabel');
            if (val.length === 0) {
                bar.css({ width: '0%' });
                label.text('');
            } else if (score <= 1) {
                bar.css({ width: '25%', 'background-color': '#EF4444' });
                label.css('color', '#EF4444').text('Weak');
            } else if (score === 2) {
                bar.css({ width: '55%', 'background-color': '#F59E0B' });
                label.css('color', '#F59E0B').text('Fair');
            } else if (score === 3) {
                bar.css({ width: '80%', 'background-color': '#0284C7' });
                label.css('color', '#0284C7').text('Good');
            } else {
                bar.css({ width: '100%', 'background-color': '#10B981' });
                label.css('color', '#10B981').text('Strong');
            }
            checkPasswordsMatch();
        });

        function checkPasswordsMatch() {
            const newVal = $('#newPasswordField').val();
            const confirmVal = $('#confirmPasswordField').val();
            $('#confirmLiveError').css('display', 'none');
            $('#confirmLiveOk').css('display', 'none');
            $('#confirmGroup').removeClass('is-invalid-border');

            if (confirmVal.length === 0) return;

            if (newVal === confirmVal) {
                $('#confirmLiveOk').css('display', 'flex');
            } else {
                $('#confirmGroup').addClass('is-invalid-border');
                $('#confirmLiveError').css('display', 'flex');
            }
        }
        $('#confirmPasswordField').on('input', checkPasswordsMatch);
        $('#currentPasswordField').on('input', function () { clearFieldError('currentGroup', 'currentLiveError'); });

        $('#passwordChangeForm').on('submit', function (e) {
            const current = $('#currentPasswordField').val();
            const newPass = $('#newPasswordField').val();
            const confirmPass = $('#confirmPasswordField').val();
            let isValid = true;

            clearFieldError('currentGroup', 'currentLiveError');
            clearFieldError('newGroup', 'newLiveError');

            if (!current) {
                showFieldError('currentGroup', 'currentLiveError');
                isValid = false;
            }
            if (newPass.length < 8) {
                showFieldError('newGroup', 'newLiveError');
                isValid = false;
            }
            if (newPass !== confirmPass) {
                $('#confirmGroup').addClass('is-invalid-border field-shake');
                $('#confirmLiveError').css('display', 'flex');
                setTimeout(function () { $('#confirmGroup').removeClass('field-shake'); }, 420);
                isValid = false;
            }

            if (!isValid) {
                e.preventDefault();
                return false;
            }

            $('#btnSubmit').attr('disabled', true);
            $('#btnIcon').removeClass('fa-save').addClass('fas fa-spinner fa-spin');
            $('#btnText').text('PROCESSING...');
        });

        @if(session('status') === 'password-updated')
            Swal.fire({
                toast: true, position: 'top-end', type: 'success',
                title: 'Password updated successfully.', showConfirmButton: false, timer: 3000
            });
        @endif

        @if(session('status') === 'profile-updated')
            Swal.fire({
                toast: true, position: 'top-end', type: 'success',
                title: 'Profile updated successfully.', showConfirmButton: false, timer: 3000
            });
        @endif

        @if($errors->updatePassword->any())
            Swal.fire({
                type: 'error', title: 'Could not update password',
                text: @json($errors->updatePassword->first()), confirmButtonColor: '#0284C7'
            });
        @endif

        @if($errors->default->any() && !$errors->updatePassword->any())
            Swal.fire({
                type: 'error', title: 'Could not update profile',
                text: @json($errors->default->first()), confirmButtonColor: '#0284C7'
            });
        @endif
    });
</script>
@stop
