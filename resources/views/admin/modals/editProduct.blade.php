<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editProductForm" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="recipient-name" class="col-form-label">Title:</label>
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                        <div class="col">
                            <label for="message-text" class="col-form-label">Color:</label>
                            <input type="text" class="form-control" id="color" name="color">
                        </div>
                    </div>
                    <div class="mb-3 row">

                        <div class="col">
                            <label for="message-text" class="col-form-label">Price:</label>
                            <input type="text" class="form-control" id="price" name="price">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col">
                            <label for="recipient-name" class="col-form-label">Image:</label>
                            <input type="file" class="form-control" id="product_image" name="product_image">
                        </div>
                        <div class="col">
                            <label for="message-text" class="col-form-label">Layer Image:</label>
                            <input type="file" class="form-control" id="layer_image" name="layer_image">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Description:</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Product</button>
                </div>
            </form>
        </div>
    </div>
</div>
