<template>
    <div>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link">
                    <p>
                        <span class="d-lg-none d-md-block">Stats</span>
                    </p>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a
                    class="nav-link dropdown-toggle"
                    id="navbarDropdownMenuLink"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                >
                    <i class="now-ui-icons media-1_button-power"></i>
                    <p>
                        <span class="d-lg-none d-md-block">visibility</span>
                    </p>
                </a>
                <div
                    class="dropdown-menu dropdown-menu-right"
                    aria-labelledby="navbarDropdownMenuLink"
                >
                    <!-- <a class="dropdown-item" unction()">Toggle online/offline</a> -->
                    <button
                        class="dropdown-item"
                        id="tgl"
                        onclick="togglefunction()"
                    >
                        Toggle online/offline
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
                    <i class="now-ui-icons ui-1_bell-53"></i>
                    <p>
                        <span class="d-lg-none d-md-block">visibility</span>
                    </p>
                </a>
                <div
                    class="dropdown-menu dropdown-menu-right"
                    aria-labelledby="navbarDropdownMenuLink"
                >
                    <strong class="dropdown-item" id=""
                        ><button
                            id="ad"
                            class="now-ui-icons ui-1_simple-add"
                        ></button>
                        Kwame needs <eta>Blood 1 pack </eta
                        ><svc>Group A+</svc> @Hospitalname</strong
                    >
                    <strong class="dropdown-item" id=""
                        ><button
                            id="ad"
                            class="now-ui-icons ui-1_simple-add"
                        ></button>
                        Kofi needs <eta>Blood 1 pack </eta
                        ><svc>Group AB</svc> @Hospitalname</strong
                    >
                    <strong class="dropdown-item" id=""
                        ><button
                            id="ad"
                            class="now-ui-icons ui-1_simple-add"
                        ></button>
                        Yaw needs a <eta>Liver 1 piece </eta
                        ><svc>Group O+</svc> @Hospitalname</strong
                    >
                    <strong class="dropdown-item" id=""
                        ><button
                            id="ad"
                            class="now-ui-icons ui-1_simple-add"
                        ></button>
                        James needs <eta>funds of 20,000 </eta
                        ><svc>before: 20-10-2020</svc> @Hospitalname</strong
                    >
                    <strong class="dropdown-item" id=""
                        ><button
                            id="ad"
                            class="now-ui-icons ui-1_simple-add"
                        ></button>
                        Sarpong needs <eta>funds of 1,000,000 </eta
                        ><svc>before: 20-10-2020</svc> @Hospitalname</strong
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
                    <i class="now-ui-icons shopping_cart-simple"></i>
                    <p>
                        <span class="d-lg-none d-md-block">visibility</span>
                    </p>
                </a>
                <div
                    class="dropdown-menu dropdown-menu-right"
                    aria-labelledby="navbarDropdownMenuLink"
                >
                    <strong class="dropdown-item" id="">
                        <button
                            id="rm"
                            class="now-ui-icons ui-1_simple-delete"
                        ></button>
                        Kwame needs <eta>Blood 1 pack </eta
                        ><svc>Group A+</svc> @Hospitalname
                        <br />
                        <button class="dropdown-item" id="ord">
                            <a
                                id="ordd"
                                class="btn btn-round btn-primary col-lg-4"
                                title="click to view profile"
                                >details</a
                            >
                            <a
                                id="ordd"
                                class="btn btn-round btn-primary col-lg-4"
                                >map</a
                            >
                            <a
                                id="ordd"
                                class="btn btn-round btn-primary col-lg-4"
                                >payments</a
                            >
                        </button>
                    </strong>
                    <strong class="dropdown-item" id="">
                        <button
                            id="rm"
                            class="now-ui-icons ui-1_simple-delete"
                        ></button>
                        Kofi needs <eta>Blood 1 pack </eta
                        ><svc>Group AB</svc> @Hospitalname
                        <br />
                        <button class="dropdown-item" id="ord">
                            <a
                                id="ordd"
                                class="btn btn-round btn-primary col-lg-4"
                                title="click to view profile"
                                >details</a
                            >
                            <a
                                id="ordd"
                                class="btn btn-round btn-primary col-lg-4"
                                >map</a
                            >
                            <a
                                id="ordd"
                                class="btn btn-round btn-primary col-lg-4"
                                >payments</a
                            >
                        </button>
                    </strong>
                    <strong class="dropdown-item" id="">
                        <button
                            id="rm"
                            class="now-ui-icons ui-1_simple-delete"
                        ></button>
                        Yaw needs a <eta>Liver 1 piece </eta
                        ><svc>Group O+</svc> @Hospitalname
                        <br />
                        <button class="dropdown-item" id="ord">
                            <a
                                id="ordd"
                                class="btn btn-round btn-primary col-lg-4"
                                title="click to view profile"
                                >details</a
                            >
                            <a
                                id="ordd"
                                class="btn btn-round btn-primary col-lg-4"
                                >map</a
                            >
                            <a
                                id="ordd"
                                class="btn btn-round btn-primary col-lg-4"
                                >payments</a
                            >
                        </button>
                    </strong>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    name: "DonorActions"
};
</script>

<style></style>
