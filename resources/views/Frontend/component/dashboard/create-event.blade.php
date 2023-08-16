<div class="modal" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="insertData">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Customer</h5>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1 createPWrapper">

                                <input type="hidden" id="update_id" value="">

                                <label class="form-label">Title *</label>
                                <input type="text" class="form-control" id="eTitle"
                                    placeholder=": Project Planing">

                                <label class="form-label mt-2">Description</label>

                                <textarea name="" class="form-control" id="description" cols="30" rows="5"></textarea>

                                <div class="row">
                                    <div class="col-md-6 mt-2">
                                        <label class="form-label">Start Date *</label>
                                        <input type="date" class="form-control" id="sDate">
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <label class="form-label">Start Time *</label>
                                        <input type="time" class="form-control" id="sTime">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mt-2">
                                        <label class="form-label">End Date *</label>
                                        <input type="date" class="form-control" id="eDate">
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <label class="form-label">End Time *</label>
                                        <input type="time" class="form-control" id="eTime">
                                    </div>
                                </div>


                                <label class="form-label mt-2">Location *</label>

                                <textarea name="" class="form-control" id="location" cols="30" rows="2"></textarea>


                                <div class="addUnitWrapper d-none" id="addUnit">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" placeholder="You Can Add Option">
                                        </div>
                                        <div class="col-md-2">
                                            <button><i class="fas fa-plus-circle"></i></button>
                                        </div>
                                    </div>


                                </div>


                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="CloseCreateProd" class="btn  btn-sm btn-danger" data-bs-dismiss="modal"
                        aria-label="Close">Close</button>
                    <button type="submit" class="btn btn-sm  btn-success">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>


<script>
    $("#CloseCreateProd").on('click', function(e) {
        document.getElementById('update_id').value = '';
        document.getElementById('eTitle').value = '';
        document.getElementById('description').value = '';
        document.getElementById('sDate').value = '';
        document.getElementById('sTime').value = '';
        document.getElementById('eTime').value = '';
        document.getElementById('eDate').value = '';
        document.getElementById('location').value = '';
        e.preventDefault();
        $('#create-modal').modal('hide');

    });




    $("#insertData").on('submit', async function(e) {
        e.preventDefault();
        let update_id = $("#update_id").val();

        if (update_id == "") {

            let eTitle = document.getElementById('eTitle').value
            let description = document.getElementById('description').value
            let sDate = document.getElementById('sDate').value
            let sTime = document.getElementById('sTime').value
            let eTime = document.getElementById('eTime').value
            let eDate = document.getElementById('eDate').value
            let location = document.getElementById('location').value
            if (eTitle.length === 0) {
                errorToast("Event Title Required !")
            }  else if (sDate.length === 0) {
                errorToast("Start Date Required !")
            } else if (sTime.length === 0) {
                errorToast("Start Time Required !")
            } else if (eTime.length === 0) {
                errorToast("End Time Required !")
            } else if (eDate.length === 0) {
                errorToast("End Date Required !")
            }else if (location.length === 0) {
                errorToast("Location Price Required !")
            }else {
                $('#create-modal').modal('hide');
                showLoader();
                

                try {
                    const res = await axios.post("/addEvents", {
                        title: eTitle,
                        start_date: sDate,
                        start_time: sTime,
                        end_date: eDate,
                        end_time: eTime,
                        location: location
                    });
                    hideLoader();
                    // console.log(res.data);


                    if (res.data.status == "success") {
                        successToast('Event Added Successfull');
                        $("#insertData").trigger("reset");
                        await getList();
                    } else if (res.data.status == "error") {
                        errorToast(res.data.message)
                    }
                } catch (error) {
                    console.error(error);
                    errorToast(error)
                }


            }
        } else {



            let id = document.getElementById('update_id').value;



            // let productName = document.getElementById('productName').value;
            // let productCatrgory = document.getElementById('catSelect').value;
            // let productPrice = document.getElementById('productPrice').value;
            // let productUnit = document.getElementById('productUnit').value;
            // let productImg = document.getElementById('productImg');
            // if (productName.length === 0) {
            //     errorToast("Product Name Required !")
            // } else if (productCatrgory.length === 0) {
            //     errorToast("Product Category Required !")
            // } else if (productPrice.length === 0) {
            //     errorToast("Product Price Required !")
            // } else if (productUnit.length === 0) {
            //     errorToast("Product Unit Required !")
            // } else if (productImg.value.length === 0) {
            //     errorToast("Product Price Required !")
            // } else {

            //     $('#create-modal').modal('hide');

            //     const imageFile = productImg.files[0];


            //     const formData = new FormData();
            //     formData.append('category_id', productCatrgory);
            //     formData.append('name', productName);
            //     formData.append('price', productPrice);
            //     formData.append('unit', productUnit);
            //     formData.append('img', imageFile);

            //     try {
            //         showLoader();
            //         const res = await axios.post("/create-product", formData, {
            //             headers: {
            //                 'Content-Type': 'multipart/form-data',
            //             },
            //         });
            //         hideLoader();

            //         if (res.data.status == "success") {
            //             successToast('Product Added Successfull');
            //             $("#insertData").trigger("reset");
            //             await getList();
            //         } else if (res.data.status == "error") {
            //             errorToast(res.data.message)
            //         }
            //     } catch (error) {
            //         console.error(error);
            //         errorToast(error)
            //     }
            // }
        }
    });
</script>
