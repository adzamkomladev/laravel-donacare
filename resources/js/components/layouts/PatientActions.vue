<template>
    <div>
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a
                    aria-expanded="false"
                    aria-haspopup="true"
                    class="nav-link dropdown-toggle"
                    data-toggle="dropdown"
                    id="navbarDropdownMenuLink"
                >
                    <i class="now-ui-icons health_ambulance"></i>
                    <p>
                        <span class="d-lg-none d-md-block" title="make request">
                            Make Request
                        </span>
                    </p>
                </a>
                <div
                    aria-labelledby="navbarDropdownMenuLink"
                    class="dropdown-menu dropdown-menu-right"
                >
                    <strong class="dropdown-item">
                        <i class="now-ui-icons media-2_sound-wave"></i>
                        <span> Make request</span>
                    </strong>
                    <button class="dropdown-item" id="ord">
                        <a class="btn btn-round btn-primary col-lg-4">
                            Blood
                        </a>
                        <a class="btn btn-round btn-primary col-lg-4">
                            Organ
                        </a>
                        <a class="btn btn-round btn-primary col-lg-4">
                            Funds
                        </a>
                    </button>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a
                    aria-expanded="false"
                    aria-haspopup="true"
                    class="nav-link dropdown-toggle"
                    data-toggle="dropdown"
                >
                    <i class="now-ui-icons design_bullet-list-67"></i>
                    <p>
                        <span class="d-lg-none d-md-block">
                            Active requests
                        </span>
                    </p>
                </a>
                <div
                    aria-labelledby="navbarDropdownMenuLink"
                    class="dropdown-menu dropdown-menu-right"
                >
                    <div class="dropdown-item" v-if="isEmpty">
                        <span>No items here</span>
                    </div>
                    <template v-else>
                        <strong class="dropdown-item">
                            <i class="now-ui-icons business_bulb-63"></i>
                            <span>{{
                                activeDonation | activeRequestText
                            }}</span>
                        </strong>
                        <a
                            class="dropdown-item"
                            href="#"
                            v-for="donation in topFourDonations"
                        >
                            <span>
                                {{ donation | activeRequestText }}
                            </span>
                        </a>
                    </template>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a
                    aria-expanded="false"
                    aria-haspopup="true"
                    class="nav-link dropdown-toggle"
                    data-toggle="dropdown"
                >
                    <i class="now-ui-icons location_pin"></i>
                    <p>
                        <span class="d-lg-none d-md-block">Active request</span>
                    </p>
                </a>
                <div
                    aria-labelledby="navbarDropdownMenuLink"
                    class="dropdown-menu dropdown-menu-right"
                >
                    <template v-if="!isEmpty && activeDonation">
                        <strong class="dropdown-item">
                            <i class="now-ui-icons location_map-big"></i>
                            <span>{{
                                activeDonation | activeRequestText
                            }}</span>
                        </strong>
                        <a class="dropdown-item" href="#">
                            <i class="now-ui-icons location_pin"></i>
                            help for Blood arrives in 30 minutes
                        </a>
                    </template>
                    <div class="dropdown-item" v-else>
                        <span>No active request</span>
                    </div>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a
                    aria-expanded="false"
                    aria-haspopup="true"
                    class="nav-link dropdown-toggle"
                    data-toggle="dropdown"
                >
                    <i class="now-ui-icons education_paper"></i>
                    <p>
                        <span class="d-lg-none d-md-block">News Feeds</span>
                    </p>
                </a>
                <div
                    aria-labelledby="navbarDropdownMenuLink"
                    class="dropdown-menu dropdown-menu-right"
                >
                    <strong class="dropdown-item">
                        <i class="now-ui-icons location_bookmark"></i>
                        <span> News Feeds</span>
                    </strong>
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
    name: "PatientActions",
    props: ["userDonations"],
    computed: {
        isEmpty() {
            return !this.userDonations || !this.userDonations.length;
        },
        topFourDonations() {
            return this.userDonations.slice(0, 4);
        },
        activeDonation() {
            const [donation] = this.topFourDonations.filter(
                donation => donation.status === "assigned"
            );
            return donation;
        }
    },
    filters: {
        activeRequestText(donation) {
            return `${donation.service.name} - ${donation.value}`;
        }
    }
};
</script>

<style></style>
