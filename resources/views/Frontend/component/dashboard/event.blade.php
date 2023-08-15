<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
            <div class="card px-5 py-5">
                <div class="row justify-content-between ">
                    <div class="align-items-center col">
                        <h4>Events</h4>
                    </div>
                    <div class="align-items-center col">
                        <button data-bs-toggle="modal" data-bs-target="#create-modal" class="float-end btn m-0 btn-sm bg-gradient-primary">Create</button>
                    </div>
                </div>
                <hr class="bg-dark "/>
                <table class="table" id="tableData">
                    <thead>
                    <tr class="bg-light">
                        <th>No</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Start Date & Time</th>
                        <th>End Date & Time</th>
                        <th>Location</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="tableList">
                    {{--Table Data--}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>


    

     getList();


    async function getList() {
        // swal("My title", "My description", "danger");

        showLoader();
        let res = await axios.get("/getEvents");
        hideLoader();


        let tableData = $('#tableData');
        let tableList = $('#tableList');

        tableData.DataTable().destroy();
        tableList.empty();

console.log(res.data);
        res.data.forEach(function (item, index) {
            let row = `<tr>
                    <td>${index + 1}</td>
                    <td>${item.title}</td>
                    <td>${item.description} </td>
                    <td>${item.start_date} ${item.start_time}</td>
                    <td>${item.end_date} ${item.end_time}</td>
                    <td>${item.location}</td>
                    <td>
                        <button data-id="${item.id}" data-name="${item.name}" data-email="${item.email}" data-mobile="${item.mobile}" class="btn edit btn-sm btn-outline-success">Edit</button>
                        <button data-id="${item.id}" data-name="${item.name}" class="btn delete btn-sm btn-outline-danger">Delete</button>
                    </td>
                </tr>`;
            tableList.append(row);
        })


        // $('.edit').on('click', function () {
        //     let id = $(this).data('id');
        //     let Name = $(this).data('name');
        //     let email = $(this).data('email');
        //     let mobile = $(this).data('mobile');


        //     $("#customerName").val(Name);
        //     $("#customerEmail").val(email);
        //     $("#customerMobile").val(mobile);


        //     $("#create-modal").modal('show');
        //     $("#update_id").val(id);
        // })

        // $('.delete').on('click', function () {
        //     let id = $(this).data('id');
        //     let Name = $(this).data('name');
        //     // console.log(Name);
        //     $(".catName").text(Name);
        //     $("#delete-modal").modal('show');
        //     $(".catID").html(id);
        // })


        tableData.DataTable({
            order: [[0, 'desc']],
            lengthMenu: [5, 10, 15, 20, 25, 30, 35, 40, 45, 50],
            language: {
                paginate: {
                    next: '&#8594;', // or '→'
                    previous: '&#8592;' // or '←'
                }
            }
        });
    }

</script>