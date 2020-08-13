<template>
  <div class="row">
    <div class="col-md-8 pb-4">
      <div class="card">
        <div class="card-body">
          <div v-if="!loading">
            <h2>{{ room.title }}</h2>
            <hr />
            <article>{{ room.description }}</article>
          </div>
          <div v-else>Loading...</div>
        </div>
      </div>
      <review-list :room-id="this.$route.params.id"></review-list>
    </div>
    <div class="col-md-4 pb-4">
      <availability
        class="mb-4"
        :room-id="this.$route.params.id"
        @availability="checkPrice($event)"
      ></availability>
      <transition name="fade">
        <price-breakdown v-if="price" :price="price" class="mb-4"></price-breakdown>
      </transition>

      <transition name="fade">
        <button
          class="btn btn-outline-secondary btn-block"
          v-if="price"
          @click="addToBasket"
          :disabled="inBasketAlready"
        >Book now</button>
      </transition>

      <button
        class="btn btn-outline-secondary btn-block"
        v-if="inBasketAlready"
        @click="removeFromBasket"
      >Remove from basket</button>

      <div
        v-if="inBasketAlready"
        class="mt-4 text-muted warning"
      >This item is in basket already, to make changes first remove it</div>
    </div>
  </div>
</template>

<script>
import Availability from "../Booking/Availability";
import ReviewList from "../Review/ReviewList";
import PriceBreakdown from "../Price/PriceBreakdown";
import { mapState, mapGetters } from "vuex";
export default {
  components: {
    Availability,
    ReviewList,
    PriceBreakdown,
  },
  data() {
    return {
      room: null,
      loading: false,
      price: null,
    };
  },
  created() {
    this.loading = true;
    axios.get(`/api/rooms/${this.$route.params.id}`).then((response) => {
      this.room = response.data.data;
      this.loading = false;
    });
  },
  computed: {
    ...mapState({
      lastSearch: "lastSearch",
    }),
    inBasketAlready() {
      if (null === this.room) {
        return false;
      }
      return this.$store.getters.inBasketAlready(this.room.id);
    },
  },
  methods: {
    async checkPrice(hasAvailability) {
      if (!hasAvailability) {
        this.price = null;
        return;
      }
      try {
        this.price = (
          await axios.get(
            `/api/rooms/${this.room.id}/price?from=${this.lastSearch.from}&to=${this.lastSearch.to}`
          )
        ).data.data;
      } catch (err) {
        this.price = null;
      }
    },
    addToBasket() {
      this.$store.dispatch("addToBasket", {
        room: this.room,
        price: this.price,
        dates: this.lastSearch,
      });
    },
    removeFromBasket() {
      this.$store.dispatch("removeFromBasket", this.room.id);
    },
  },
};
</script>