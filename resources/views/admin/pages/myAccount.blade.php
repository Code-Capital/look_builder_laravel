@extends('admin.layout.master')
@section('content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid pt-5">
            <div class="row ">
                <div class="col-xl-6 mb-3">
                    <!-- Personal-Information -->
                    <div class="card min-height">
                        <div class="card-body">
                            <h4 class="header-title mt-0 mb-3">Seller Information</h4>
                            <div class="text-start">
                                <p class="text-muted"><strong>Full Name :</strong> <span
                                        class="ms-2">{{ Auth::user()->name }}</span></p>

                                <p class="text-muted"><strong>Mobile :</strong><span
                                        class="ms-2">{{ Auth::user()->phone }}</span></p>

                                <p class="text-muted"><strong>Email :</strong> <span
                                        class="ms-2">{{ Auth::user()->email }}</span></p>

                                <p class="text-muted"><strong>Country :</strong> <span
                                        class="ms-2">{{ Auth::user()->country }}</span></p>
                            </div>
                            <div class="text-end">
                                <button type="button" class="btn btn-primary editProfile" data-bs-toggle="modal"
                                    data-bs-target="#editModal">Edit Information</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 h-100 mb-3">
                    <div class="card min-height">
                        <div class="card-body">
                            <h4 class="header-title mt-0 mb-3">Update Passeord</h4>
                            <form method="POST" id="updatePasswordForm" method="POST">
                                @csrf
                                <div class="row mt-3">
                                    <div class="col">
                                        <label for="current_password">Current Password</label>
                                        <input class="form-control" type="password" name="current_password"
                                            id="current_password" required>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col">
                                        <label for="new_password">New Password</label>
                                        <input class="form-control" type="password" name="new_password" id="new_password"
                                            required>
                                    </div>
                                    <div class="col">
                                        <label for="confirm_password">Confirm Password</label>
                                        <input class="form-control" type="password" name="password_confirmation"
                                            id="confirm_password" required>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button class="mt-3 btn btn-primary" type="submit">Update Password</button>
                                </div>
                            </form>
                        </div>
                    </div>


                </div>

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <h4 class="py-4">All Users</h4>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#addUserModal">Add New User</button>
                            </div>
                            <table class="table table-sm table-striped table-centered mb-0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Eamil</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td class="table-user">
                                                {{ $user->name }}
                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td class="table-action">
                                                {{-- <a data-bs-toggle="modal" data-bs-target="#editUserModal"
                                                    class="action-icon">
                                                    <i class="mdi mdi-pencil"></i></a> --}}
                                                <a id="deleteUser" class="deleteUser" data-user-id="{{ $user->id }}"
                                                    class="action-icon">
                                                    <i class="mdi mdi-delete"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.modals.editProfile')
    @include('admin.modals.addUser')
@endsection
@push('scripts')
    <script src="{{ asset('assets/js/custom/profile.js') }}"></script>
    <script>
        $(".deleteUser").click(function(e) {
            e.preventDefault();

            var userId = $(this).data("user-id");

            $.ajax({
                type: "DELETE",
                url: "/user/" + userId,
                data: {
                    _token: "{{ csrf_token() }}",
                    product_id: userId,
                },
                success: function(response) {
                    toastr.options = {
                        progressBar: true,
                        closeButton: true,
                        timeOut: 2000,
                    };
                    console.log(response);
                    if (response.status == true) {
                        toastr.success(response.message, "Success");
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    } else {
                        toastr.error(response.message, "Error");
                    }
                },
                error: function(data) {
                    const errorMessages = Object.values(
                        errors?.responseJSON?.errors
                    ).flat();
                    toastr.options = {
                        progressBar: true,
                        closeButton: true,
                    };
                    for (let i = 0; i < errorMessages.length; i++) {
                        toastr.error(errorMessages[i], "Error");
                    }
                },
            });
        });
    </script>
@endpush
