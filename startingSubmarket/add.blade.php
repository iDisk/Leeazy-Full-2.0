@php 
$form_data = [
    'page_title'=> 'Add Staritng Submarket',
    'page_subtitle'=> '', 
    'form_name' => 'Add Staritng Submarket Form',
    'form_id' => 'add_submarket',
    'action' => URL::to('/').'/admin/settings/add-starting-submarket',
    'form_type' => 'file',
    'fields' => [
        ['type' => 'select', 'options' => $result, 'class' => 'validate_field', 'label' => 'City', 'name' => 'city', 'value' => ''],
        ['type' => 'text', 'class' => '', 'label' => ' Staring Submarket Name', 'name' => 'name', 'value' => ''],
        ['type' => 'select', 'options' => ['Active' => 'Active', 'Inactive' => 'Inactive'], 'class' => 'validate_field', 'label' => 'Status', 'name' => 'status', 'value' => ''],
    ]
];
@endphp
@include("admin.common.form.setting", $form_data)

<script src="{{ asset('public/backend/js/additional-method.min.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function () {

            $('#add_submarket').validate({
                rules: {
                    city: {
                        required: true
                    },
                    name: {
                        required: true
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