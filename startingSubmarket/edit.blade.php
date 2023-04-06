@php 
$form_data = [
    'page_title'=> 'Edit Staritng Submarket',
    'page_subtitle'=> '', 
    'form_name' => 'Edit Staritng Submarket Form',
    'form_id' => 'edit_staritng_submarket',     
    'action' => URL::to('/').'/admin/settings/edit-starting-submarket/'.$result->id,
    'form_type' => 'file',
    'fields' => [
        ['type' => 'select', 'options' => $cities, 'class' => 'validate_field', 'label' => 'City', 'name' => 'city', 'value' => $result->city_id],
        ['type' => 'text', 'class' => '', 'label' => ' Staring Submarket Name', 'name' => 'name', 'value' => $result->name],
        ['type' => 'select', 'options' => ['Active' => 'Active', 'Inactive' => 'Inactive'], 'class' => 'validate_field', 'label' => 'Status', 'name' => 'status', 'value' => $result->status],
    ]
  ];
@endphp
@include("admin.common.form.setting", $form_data)

<script src="{{ asset('public/backend/js/additional-method.min.js') }}"></script>

<script type="text/javascript">
   $(document).ready(function () {

            $('#edit_staritng_city').validate({
                rules: {
                    name: {
                        required: true
                    },
                    image: {
                        
                        //extension: "jpg|png|jpeg"
                        accept: "image/jpg,image/jpeg,image/png"
                    }
                },
                messages: {
                    image: {
                        accept: 'The file must be an image (jpg, jpeg or png)'
                    }
                }
            });

        });
</script>