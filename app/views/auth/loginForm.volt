<h1>Log in</h1>
{{ flashSession.output() }}
<form action="{{ url.get({'for': 'login'}) }}" method="post">
    <input type='hidden' name='{{ security.getTokenKey() }}'
           value='{{ security.getToken() }}'/>

    <div class="form-group">
        <label for="licenseNumber">Driver's license number</label>
        <input type="text" class="form-control" id="licenseNumber" name="licenseNumber"
               data-inputmask="'mask': 'A9999-99999-99999'"
               value="{{ old.licenseNumber|default('') }}"
               placeholder="Driver's license number" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
    </div>
    <button type="submit" class="btn btn-primary">Log in</button>
</form>