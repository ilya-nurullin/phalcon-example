<h1>Register</h1>
{{ flashSession.output() }}
<form action="{{ url.get({'for': 'register'}) }}" method="post">
    <input type='hidden' name='{{ security.getTokenKey() }}'
           value='{{ security.getToken() }}'/>

    <div class="form-group">
        <label for="firstName">First name</label>
        <input type="text" class="form-control" name="firstName" id="firstName" placeholder="First name"
               value="{{ old.firstName|default('') }}" required>
    </div>
    <div class="form-group">
        <label for="lastName">Last name</label>
        <input type="text" class="form-control" name="lastName" id="lastName" placeholder="Last name"
               value="{{ old.lastName|default('') }}" required>
    </div>
    <div class="form-group">
        <label for="age">Age</label>
        <input type="number" class="form-control" name="age" id="age" placeholder="Age" min="1" max="99"
               value="{{ old.age|default('') }}" required>
    </div>
    <div class="form-group">
        <label for="phone">Phone number</label>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text">+1</div>
            </div>
            <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone number"
                   data-inputmask="'mask': '9999999999'"
                   value="{{ old.phone|default('') }}" required>
        </div>
    </div>
    <div class="form-group">
        <label for="licenseNumber">Driver's license number in A9999-99999-99999 format</label>
        <input type="text" class="form-control" name="licenseNumber"
               data-inputmask="'mask': 'A9999-99999-99999'"
               id="licenseNumber" placeholder="Driver's license number"
               value="{{ old.licenseNumber|default('') }}" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Password" minlength="6"
               value="{{ old.password|default('') }}" required>
    </div>
    <div class="form-group">
        <label for="address">Address</label>
        <textarea class="form-control" name="address" id="address" cols="30"
                  rows="5">{{ old.address|default('') }}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Register</button>
</form>
