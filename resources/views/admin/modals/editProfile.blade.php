<div id="editUserModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h4 class="py-3 h3 text-center"> Edit Personal Information</h4>
                <form class="ps-3 pe-3" id="updateProfileForm" method="POST">
                    @csrf
                    <div class="mb-2">
                        <label for="username" class="form-label">Full Name</label>
                        <input class="form-control" id="name" name="name" type="text" required
                            placeholder="">
                    </div>
                    <div class="mb-2">
                        <label for="emailaddress" class="form-label">Email address</label>
                        <input class="form-control" id="email" name="email" type="email" disabled required
                            placeholder="">
                    </div>
                    <div class="mb-2">
                        <label for="password" class="form-label">Mobile</label>
                        <input class="form-control" type="text" id="phone" name="phone" required
                            placeholder="">
                    </div>
                    <div class="mb-2">
                        <label for="password" class="form-label">Country</label>
                        <input class="form-control" type="text" id="country" name="country" required
                            placeholder="">
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
