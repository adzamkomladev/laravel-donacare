<template>
    <div>
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a
                    class="nav-link dropdown-toggle"
                    id="navbarDropdownMenuLink"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                >
                    <i class="now-ui-icons health_ambulance"></i>
                    <p>
                        <span class="d-lg-none d-md-block" title="make request"
                            >Make Request</span
                        >
                    </p>
                </a>
                <div
                    class="dropdown-menu dropdown-menu-right"
                    aria-labelledby="navbarDropdownMenuLink"
                >
                    <strong class="dropdown-item"
                        ><lc class="now-ui-icons media-2_sound-wave"></lc
                        ><eta> Make request</eta></strong
                    >
                    <button class="dropdown-item" id="ord">
                        <a id="mr" class="btn btn-round btn-primary col-lg-4"
                            >Blood</a
                        >
                        <a id="mr" class="btn btn-round btn-primary col-lg-4"
                            >Organ</a
                        >
                        <a id="mr" class="btn btn-round btn-primary col-lg-4"
                            >Funds</a
                        >
                    </button>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a
                    class="nav-link dropdown-toggle"
                    id="navbarDropdownMenuLink"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                >
                    <i class="now-ui-icons design_bullet-list-67"></i>
                    <p>
                        <span class="d-lg-none d-md-block"
                            >Active requests</span
                        >
                    </p>
                </a>
                <div
                    class="dropdown-menu dropdown-menu-right"
                    aria-labelledby="navbarDropdownMenuLink"
                >
                    <strong class="dropdown-item"
                        ><lc class="now-ui-icons business_bulb-63"></lc
                        ><eta> Active Requests</eta></strong
                    >
                    <a class="dropdown-item" href="#"
                        ><svc>Active request 1</svc></a
                    >
                    <a class="dropdown-item" href="#"
                        ><svc>Active request 2</svc></a
                    >
                    <a class="dropdown-item" href="#"
                        ><svc>Active request 3</svc></a
                    >
                </div>
            </li>
            <li class="nav-item dropdown">
                <a
                    class="nav-link dropdown-toggle"
                    id="navbarDropdownMenuLink"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                >
                    <i class="now-ui-icons location_pin"></i>
                    <p>
                        <span class="d-lg-none d-md-block">ETA</span>
                    </p>
                </a>
                <div
                    class="dropdown-menu dropdown-menu-right"
                    aria-labelledby="navbarDropdownMenuLink"
                >
                    <strong class="dropdown-item"
                        ><lc class="now-ui-icons location_map-big"></lc
                        ><eta> ETA</eta></strong
                    >
                    <a class="dropdown-item" href="#"
                        ><lc class="now-ui-icons location_pin"></lc> help for
                        <svc>Blood</svc> arrives in <eta>30 minutes</eta></a
                    >
                    <a class="dropdown-item" href="#"
                        ><lc class="now-ui-icons location_pin"></lc> help for
                        <svc>left inner ventricle</svc> arrives in
                        <eta>1 hourr 45 minutes</eta></a
                    >
                    <a class="dropdown-item" href="#"
                        ><lc class="now-ui-icons location_pin"></lc> help for
                        <svc>testacle sac</svc> arrives in
                        <eta>30 years</eta></a
                    >
                </div>
            </li>
            <li class="nav-item dropdown">
                <a
                    class="nav-link dropdown-toggle"
                    id="navbarDropdownMenuLink"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                >
                    <i class="now-ui-icons education_paper"></i>
                    <p>
                        <span class="d-lg-none d-md-block">News Feeds</span>
                    </p>
                </a>
                <div
                    class="dropdown-menu dropdown-menu-right"
                    aria-labelledby="navbarDropdownMenuLink"
                >
                    <strong class="dropdown-item"
                        ><lc class="now-ui-icons location_bookmark"></lc
                        ><eta> News Feeds</eta></strong
                    >
                    <a class="dropdown-item" href="#">Feed 1</a>
                    <a class="dropdown-item" href="#">Feed 1</a>
                    <a class="dropdown-item" href="#">Feed 1</a>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    name: "PatientActions"
};
</script>

<style></style>
