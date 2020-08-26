<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Phalcon</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            {% if session.has('auth') %}
                <li class="nav-item">
                    <form action="{{ url.get({'for': 'logout'}) }}" name="logout" method="post">
                        <input type='hidden' name='{{ security.getTokenKey() }}'
                               value='{{ security.getToken() }}'/>
                        <a href="#" onclick="document.forms.logout.submit()" class="nav-link">Log out</a>
                    </form>
                </li>
            {% else %}
                <li class="nav-item">
                    <a href="{{ url.get({'for': 'loginForm'}) }}" class="nav-link">Log in</a>
                </li>
                <li class="nav-item">
                    <a href="{{ url.get({'for': 'registerForm'}) }}" class="nav-link">Register</a>
                </li>
            {% endif %}
            <li class="nav-item">
                <a href="{{ url.get({'for': 'admin'}) }}" class="nav-link">Admin area</a>
            </li>
        </ul>
    </div>
</nav>