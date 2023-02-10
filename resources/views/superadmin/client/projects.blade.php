<div class="border border-secondary" style="padding: 20px;">

    <div class="page-header flex-wrap">
        <h5 class="mb-0">
            Project
        </h5>
        <div class="d-flex">
            <!-- <a href="#" id="newbutton" data-toggle="modal" data-target="#noteCreate"> Create Note </a> -->
        </div>
    </div>
    <!-- alert section -->
    <!-- <div class="alert alert-success" id="removeprojectAlert" style="display:none"></div> -->
    <!-- alert section end-->
    <!-- table start -->
    <div class="table-responsive" style="overflow-x:scroll;">
        <table class="table text-center">
            <caption class="project-main-table"></caption>
            <thead>
                <tr>
                    <th class="border border-secondary">S/N</th>
                    <th class="border border-secondary">Project Name</th>
                    <th class="border border-secondary">Starting Date</th>
                    <th class="border border-secondary">Ending Date</th>
                    <th class="border border-secondary"> Status</th>
                    <th class="border border-secondary" colspan="3">Action</th>
                </tr>
            </thead>
            <tbody class="listproject">

            </tbody>
        </table>
    </div>
    <ul class="project-pagination-refs pagination-referece-css pagination justify-content-center"></ul>
    <!-- table end here -->
</div>

<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- backend js file -->
<script>
    

    // All Product Details
  

    function gfhgfhf() {
        console.log('Product');

        $.ajax({
            type: "GET",
            url: "",
            // data: {
            //     'id': id,
            // },

            success: function(response) {
                let i = 0;
                $('.').html('');
                $('.project-main-table').html('Total no. of project : ' + response.total);
                jQuery.each(response, function(key, value) {
                    let date = new Date(value["created_at"])
                    $('.').append('<tr>\
                        <td class="p-2 border border-secondary">' + ++i + '</td>\
                        <td class="p-2 border border-secondary">' + value["title_name"] + '</td>\
                        <td class="p-2 border border-secondary">' + date.toLocaleDateString() + '</td>\
                        <td class="p-2 border border-secondary"><a name="projectview"  data-toggle="modal" data-id="' + value["id"] + '"  data-target=".viewproject"> <i class="mdi mdi-eye"></i> </a></td>\
                        <td class="p-2 border border-secondary"><a name="projectedit" data-toggle="modal" data-id="' + value["id"] + '" data-target="#editproject"> <i class="mdi mdi-pencil"></i> </a></td>\
                        <td  class="p-2 border border-secondary"><a name="deleteproject" data-toggle="modal" data-target="#removeproject" data-id="' + value["id"] + '" > <i class="mdi mdi-delete"></i> </a></td>\
                    </tr>');
                });
                $('.project-pagination-refs').html('');
                jQuery.each(response.links, function(key, value) {
                    $('.project-pagination-refs').append(
                        '<li id="project_pagination" class="page-item ' + ((value.active === true) ? 'active' : '') + '" ><a href="' + value['url'] + '" class="page-link" >' + value["label"] + '</a></li>'
                    );
                });
            }
        });
    }
    // });
    // End function here

    // pagination links css and access page
    $(function() {
        $(document).on("click", "#project_pagination", function() {
            //get url and make final url for ajax
            var url = $(this).attr("href");
            var append = url.indexOf("?") == -1 ? "?" : "&";
            var finalURL = url + append;


            $.get(finalURL, function(response) {
                let i = response.from;

                $('.').html('');
                $('.project-main-table').html('Total no. of project : ' + response.total);
                jQuery.each(response.data, function(key, value) {
                    $('.').append('<tr>\
                        <td class="border border-primary">' + i++ + '</td>\
                        <td class="p-2 border border-secondary">' + value["title_name"] + '</td>\
                        <td class="p-2 border border-secondary">' + value[""] + '</td>\
                        <td class="border border-primary"><a name=""  data-toggle="modal" data-id="' + value["id"] + '"  data-target="#"> <i class="mdi mdi-eye"></i> </a></td>\
                        <td class="border border-primary"><a name="editUser" onclick="myvalidation()" data-toggle="modal" data-id="' + value["id"] + '" data-target="#editUser"> <i class="mdi mdi-pencil"></i> </a></td>\
                        <td class="border border-primary"><a name="deleteproject" data-toggle="modal" data-target="#removeproject" data-id="' + value["id"] + '" > <i class="mdi mdi-delete"></i> </a></td>\
                    </tr>');
                });
                $('.project-pagination-refs').html('');
                jQuery.each(response.links, function(key, value) {
                    $('.project-pagination-refs').append(
                        '<li id="project_pagination" class="page-item ' + ((value.active === true) ? 'active' : '') + '" ><a href="' + value['url'] + '" class="page-link" >' + value["label"] + '</a></li>'
                    );
                });
            });
            return false;
        });
    });
    // pagination end here
   
    
    
   
</script>
