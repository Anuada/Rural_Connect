export const update_profile_form = `
    <div class="card p-4 shadow-lg rounded">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="text-center mb-0">Update Profile</h3>
            <a href="#" id="changePassword" class="btn btn-secondary">Change Password <i style="margin-left: 10px"
                    class="fa fa-arrow-right" aria-hidden="true"></i>
            </a>
        </div>
        <form id="updateProfileForm">
            <div class="mb-3">
                <label for="fname" class="form-label">First Name</label>
                <input type="text" id="fname" name="fname" class="form-control" required>
                <div style="height: 15px" class="text-danger" id="fnameError"></div>
            </div>
            <div class="mb-3">
                <label for="lname" class="form-label">Last Name</label>
                <input type="text" id="lname" name="lname" class="form-control" required>
                <div style="height: 15px" class="text-danger" id="lnameError"></div>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" id="address" name="address" class="form-control"
                    required>
                <div style="height: 15px" class="text-danger" id="addressError"></div>
            </div>
            <div class="mb-3">
                <label for="DOB" class="form-label">Date Of Birth</label>
                <input type="date" id="DOB" name="DOB" class="form-control"
                    required>
                <div style="height: 15px" class="text-danger" id="dobError"></div>
            </div>
            <div class="mb-3">
                <label for="contactNo" class="form-label">Contact Number</label>
                <input type="text" id="contactNo" name="contactNo" class="form-control" required>
                <div style="height: 15px" class="text-danger" id="contactNoError"></div>
            </div>
            <button type="submit" name="submit" class="btn btn-primary w-100">Update Profile</button>
        </form>
    </div>
`;

export const change_password_form = `
    <div class="card p-4 shadow-lg rounded">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="#" id="updateProfile" class="btn btn-secondary"><i style="margin-right: 10px" class="fa fa-arrow-left"
                    aria-hidden="true"></i>Update Profile</a>
            <h3 class="text-center mb-0">Change Password</h3>
        </div>
        <form method="POST" id="changePasswordForm">
            <div class="mb-3">
                <label for="current_password" class="form-label">Current Password</label>
                <input type="password" id="current_password" name="current_password" class="form-control" required>
                <div style="height: 15px" class="text-danger" id="current_passwordError"></div>
            </div>
            <div class="mb-3">
                <label for="new_password" class="form-label">New Password</label>
                <input type="password" id="new_password" name="new_password" class="form-control" required>
                <div style="height: 15px" class="text-danger" id="new_passwordError"></div>
            </div>
            <div class="mb-3">
                <label for="repeat_password" class="form-label">Repeat Password</label>
                <input type="password" id="repeat_password" name="repeat_password" class="form-control" required>
                <div style="height: 15px" class="text-danger" id="repeat_passwordError"></div>
            </div>
            <button type="submit" name="submit" class="btn btn-primary w-100">Change Password</button>
        </form>
    </div>
`;