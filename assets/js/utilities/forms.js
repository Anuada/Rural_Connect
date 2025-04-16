export const update_profile_form = `
    <div class="card p-4 shadow-lg rounded">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="text-center mb-0">Update Profile</h3>
            <a href="#" id="changePassword" class="text-decoration-none text-white">Change Password <i style="margin-left: 10px"
                    class="fa fa-arrow-right" aria-hidden="true"></i>
            </a>
        </div>
        <form id="updateProfileForm">
            <div class="form-fields">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="fname"">First Name</label>
                        <input type="text" id="fname" name="fname" required>
                        <div style="height: 15px" class="text-danger" id="fnameError"></div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lname"">Last Name</label>
                        <input type="text" id="lname" name="lname" required>
                        <div style="height: 15px" class="text-danger" id="lnameError"></div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="address"">Address</label>
                        <input type="text" id="address" name="address"
                            required>
                        <div style="height: 15px" class="text-danger" id="addressError"></div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="DOB"">Date Of Birth</label>
                        <input type="date" id="DOB" name="DOB"
                            required>
                        <div style="height: 15px" class="text-danger" id="dobError"></div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="contactNo"">Contact Number</label>
                        <input type="text" id="contactNo" name="contactNo" required>
                        <div style="height: 15px" class="text-danger" id="contactNoError"></div>
                    </div>
                </div>
                <button type="submit" name="submit">Update Profile</button>
            </div>
        </form>
    </div>
`;

export const change_password_form = `
    <div class="card p-4 shadow-lg rounded">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="#" id="updateProfile" class="text-decoration-none text-white"><i style="margin-right: 10px" class="fa fa-arrow-left"
                    aria-hidden="true"></i>Update Profile</a>
            <h3 class="text-center mb-0">Change Password</h3>
        </div>
        <form method="POST" id="changePasswordForm">
            <div class="form-fields">
                <div class="mb-3">
                    <label for="current_password">Current Password</label>
                    <input type="password" id="current_password" name="current_password" required>
                    <div style="height: 15px" class="text-danger" id="current_passwordError"></div>
                </div>
                <div class="mb-3">
                    <label for="new_password">New Password</label>
                    <input type="password" id="new_password" name="new_password" required>
                    <div style="height: 15px" class="text-danger" id="new_passwordError"></div>
                </div>
                <div class="mb-3">
                    <label for="repeat_password">Repeat Password</label>
                    <input type="password" id="repeat_password" name="repeat_password" required>
                    <div style="height: 15px" class="text-danger" id="repeat_passwordError"></div>
                </div>
                <button type="submit" name="submit" class="btn btn-primary w-100">Change Password</button>
            </div>
        </form>
    </div>
`;