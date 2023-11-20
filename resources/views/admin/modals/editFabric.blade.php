<div class="modal fade" id="editFabricModal" tabindex="-1" aria-labelledby="editFabricModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editFabricModalLabel">Edit Fabric</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editFabricForm" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="recipient-name" class="col-form-label">Name:</label>
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                        <div class="col">
                            <label for="recipient-name" class="col-form-label">Woven By:</label>
                            <input type="text" class="form-control" id="woven_by" name="woven_by">
                        </div>

                    </div>
                    <div class="mb-3 row">
                        <div class="col">
                            <label for="recipient-name" class="col-form-label">Composition:</label>
                            <input type="text" class="form-control" id="composition" name="composition">
                        </div>
                        <div class="col">
                            <label for="message-text" class="col-form-label">Weight:</label>
                            <input type="text" class="form-control" id="weight" name="weight">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col">
                            <label for="recipient-name" class="col-form-label">Price:</label>
                            <input type="text" class="form-control" id="price" name="price">
                        </div>
                        <div class="col">
                            <label for="message-text" class="col-form-label">Image:</label>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col">

                            <label for="message-text" class="col-form-label">Season:</label>
                            <input class="form-control" id="season" name="season">
                        </div>


                        <div class="col">

                            <label for="message-text" class="col-form-label">Code:</label>
                            <input class="form-control" id="fabric_code" name="fabric_code">
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Fabric</button>
                </div>
            </form>
        </div>
    </div>
</div>
