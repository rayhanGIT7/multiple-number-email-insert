<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>index</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <!-- Button to trigger the modal -->
    <button style="margin-left: 80%; margin-top:2%;" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        + Add Employee
    </button>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Employee</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('employee.insert') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" id="name" class="form-control" name="name" value="{{ old('name') }}" autofocus autocomplete="name">
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email Address -->
                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <div id="emailContainer">
                                <div class="input-group mb-3">
                                    <input type="email" class="form-control" name="emails[]" autocomplete="username">
                                    <button type="button" class="btn btn-outline-primary" onclick="addEmailField()">Add Email</button>
                                </div>
                            </div>
                            @error('emails.*')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Phone Number -->
                        <div class="mb-3">
                            <label for="number" class="form-label">Phone Number</label>
                            <div class="input-group mb-3" id="numberContainer">
                                <input type="number" id="number" class="form-control" name="numbers[]" value="{{ old('numbers.0') }}" autofocus autocomplete="name">
                                <button type="button" class="btn btn-outline-primary" onclick="addNumberField()">Add Number</button>
                            </div>
                            @error('numbers.*')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Department -->

                        <div class="mb-3">
                            <label for="name" class="form-label">Department</label>
                            <select name="department" id="department" class="form-control" value="{{ old('department') }}" autofocus autocomplete="name">
                                <option disabled selected>Select Department</option>
                                <option value="Admin">Admin</option>
                                <option value="HR">HR</option>
                                <option value="Web Developer">Web Developer</option>
                                <option value="Apps Developer">Apps Developer</option>
                            </select>
                            @error('department')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- district -->
                        <div class="mb-3">
                            <label for="district" class="form-label">District</label>
                            <select name="district" id="district" class="form-control" onchange="updateDropdownOptions(this)">
                                <option disabled selected>Select District</option>
                                @foreach($district as $value)
                                <option>{{ $value->district }}</option>
                                @endforeach
                            </select>
                            @error('district')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>




                        <!-- upazila -->
                        <div class="mb-3" id="upazilaContainer" style="display: none;">
                            <label for="upazila" class="form-label">Upazila</label>
                            <select name="upazila" id="upazila" class="form-control" value="{{ old('upazila') }}" autofocus autocomplete="name">
                                <option disabled selected>Select Upazila</option>
                                <!-- Options will be dynamically populated using JavaScript -->
                            </select>
                            @error('upazila')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>



                        <div class="mb-3">
                            <label for="date" class="form-label">Joining Date</label>
                            <input type="date" id="date" class="form-control" name="date" value="{{ old('date') }}" autofocus autocomplete="name">
                            @error('date')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Gender</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="male" value="male" {{ old('gender') === 'male' ? 'checked' : '' }}>
                                <label class="form-check-label" for="male">
                                    Male
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="female" value="female" {{ old('gender') === 'female' ? 'checked' : '' }}>
                                <label class="form-check-label" for="female">
                                    Female
                                </label>
                            </div>

                            @error('gender')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="name" class="form-label">image</label>
                            <input type="file" id="image" class="form-control" name="image" value="{{ old('image') }}" autofocus autocomplete="name">
                            @error('image')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-end">
                            <a class="text-secondary text-decoration-none me-3" href="{{ route('login') }}">Already registered?</a>
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="container mt-5">
        <h2>Employee Table</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">Department</th>
                    <th scope="col">District</th>
                    <th scope="col">Upazila</th>
                    <th scope="col">Joining Date</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Image</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $employee)
                <tr>
                    <td>{{ $employee->name }}</td>
                    <<td>
                        @foreach(json_decode($employee->emails) as $email)
                        {{ $email }}<br>
                        @endforeach
                        </td>
                        <td>
                            @foreach(json_decode($employee->numbers) as $number)
                            {{ $number }}<br>
                            @endforeach
                        </td>

                        <td>{{ $employee->department }}</td>
                        <td>{{ $employee->district }}</td>
                        <td>{{ $employee->upazila }}</td>
                        <td>{{ $employee->date }}</td>
                        <td>{{ $employee->gender }}</td>
                        <td>
                            <?php
                            if (!empty($employee->image)) {
                                $imageData = base64_decode($employee->image);
                                $finfo = new finfo(FILEINFO_MIME_TYPE);
                                $imageType = $finfo->buffer($imageData);
                            ?>
                                <img src='data:<?php echo $imageType; ?>;base64,<?php echo base64_encode($imageData); ?>' style='max-width: 50px; max-height: 100px;' class="img-thumbnail">
                            <?php } else { ?>
                                <!-- Handle the case where image data is empty -->
                                No Image
                            <?php } ?>
                        </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        // Add multiple phone number & remove
        const maxNumberFields = 2;

        function addNumberField() {
            const container = document.getElementById('numberContainer');
            const numberFields = container.querySelectorAll('.input-group');

            if (numberFields.length < maxNumberFields) {
                const newInput = document.createElement('div');
                newInput.className = 'input-group mb-3';
                newInput.innerHTML = `
        <input type="number" class="form-control" name="numbers[]" autocomplete="username">
        <button type="button" class="btn btn-outline-danger" onclick="removeNumberField(this)">Remove</button>
      `;
                container.appendChild(newInput);
            }
        }

        function removeNumberField(button) {
            const container = document.getElementById('numberContainer');
            container.removeChild(button.parentElement);
        }
        // Add multiple Email & remove
        const maxEmailFields = 3;

        function addEmailField() {
            const container = document.getElementById('emailContainer');
            const emailFields = container.querySelectorAll('.input-group');


            if (emailFields.length < maxEmailFields) {
                const newInput = document.createElement('div');
                newInput.className = 'input-group mb-3';
                newInput.innerHTML = `
        <input type="email" class="form-control" name="emails[]" autocomplete="username">
        <button type="button" class="btn btn-outline-danger" onclick="removeEmailField(this)">Remove</button>
      `;
                container.appendChild(newInput);
            }
        }

        function removeEmailField(button) {
            const container = document.getElementById('emailContainer');
            container.removeChild(button.parentElement);
        }

        // district,upazila,village


        function updateDropdownOptions(selectElement) {
            const selectedValue = selectElement.value;
            console.log(selectedValue);
            const dependentDropdown = document.getElementById('upazila');
            const dependent = document.getElementById('upazilaContainer');

            // Hide the 'Upazila' dropdown initially
            dependentDropdown.style.display = 'none';

            // Check if a valid district is selected
            if (selectedValue) {
                $.ajax({
                    url: "{{ route('employee.getData') }}",
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        district: selectedValue
                    },
                    success: function(data) {
                        data.forEach(optionValue => {
                            const option = document.createElement('option');
                            option.value = optionValue;
                            option.text = optionValue;
                            dependentDropdown.appendChild(option);
                        });

                        // Show the 'Upazila' dropdown after populating options
                        dependent.style.display = 'block';
                        dependentDropdown.style.display = 'block';


                    },
                    error: function(error) {
                        console.error('Error fetching data:', error);
                    }
                });
            }
        }
    </script>

</body>

</html>
