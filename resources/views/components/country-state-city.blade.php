<div>
    <div class="select-wrapper mx-0 w-100 d-flex flex-column">
        <div class="col-lg-4':'px-0 w-100">
            <select id="country" name="country" class="select21 location country max-w-100">
                <option value="">Select Country</option>
                @foreach (countries() as $country)
                    <option value="{{ $country['name'] }}" required>{{ $country['name'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-4':'px-0 w-100">
            <select id="state" name="state" class="select21 location state max-w-100">
                <option value="">Select State </option>
            </select>
        </div>
        <div class="col-lg-4':'px-0 w-100">
            <select id="city" name="district" class="select21 location city max-w-100">
                <option value="">Select City </option>
            </select>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(".select21").select2();

        $("#country").on('change', function() {
            let countryName = $(this).val();
            $.ajax({
                url: '/get-states-by-country',
                type: 'GET',
                data: {
                    country: countryName
                },
                success: function(response) {
                    $("#state").html(response);
                    $("#state").trigger('change');
                }
            });
        });

        $("#state").on('change', function() {
            let stateName = $(this).val();
            $.ajax({
                url: '/get-cities-by-state',
                type: 'GET',
                data: {
                    state: stateName
                },
                success: function(response) {
                    $("#city").html(response);
                    $("#city").trigger('change');
                }
            });
        });
    });
</script>
