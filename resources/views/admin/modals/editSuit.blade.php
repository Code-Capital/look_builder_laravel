<div id="editSuitModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h4 class="py-3 h3 text-center"> Edit Suit</h4>
                <form class="ps-3 pe-3" id="updateSuitForm" method="POST">
                    @csrf
                    <div class="mb-2">
                        <label for="username" class="form-label">Title</label>
                        <input class="form-control" id="title" name="title" type="text" required
                            placeholder="">
                    </div>
                    <div class="mb-2">
                        <label for="username" class="form-label">Description</label>
                        <input class="form-control" id="description" name="description" type="text" required
                            placeholder="">
                    </div>
                    <div class="mb-2">
                        <label for="emailaddress" class="form-label">Product image</label>
                        <input class="form-control" id="product_image" name="product_image" type="file"
                            placeholder="">
                    </div>
                    <div class="mb-2">
                        <label for="emailaddress" class="form-label">Select Jacket</label>
                        <select class="form-select" aria-label="Default select example" name="shirt_id">
                            <option selected>Select Shirt</option>
                            @foreach ($jackets as $jacket)
                                <option value="{{ $jacket->id }}">{{ $jacket->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="emailaddress" class="form-label">Select Trouser</label>
                        <select class="form-select" aria-label="Default select example" name="trouser_id">
                            <option selected>Select Trouser</option>
                            @foreach ($trousers as $trouser)
                                <option value="{{ $trouser->id }}">{{ $trouser->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
