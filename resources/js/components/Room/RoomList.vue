<template>
  <div>
    <div v-if="loading">Data is loading...</div>
    <div v-else>
      <div class="row mb-4" v-for="row in rows" :key="'row' + row">
        <div
          class="col d-flex align-items-stretch"
          v-for="(room, column) in roomsInRow(row)"
          :key="'row' + row + column"
        >
          <room-list-item v-bind="room"></room-list-item>
        </div>

        <div class="col" v-for="p in placeholdersInRow(row)" :key="'placeholder' + row + p"></div>
      </div>
    </div>
  </div>
</template>

<script>
import RoomListItem from "./RoomListItem";
export default {
  components: {
    RoomListItem,
  },
  data() {
    return {
      rooms: null,
      loading: false,
      columns: 3,
    };
  },
  computed: {
    rows() {
      return this.rooms === null
        ? 0
        : Math.ceil(this.rooms.length / this.columns);
    },
  },
  methods: {
    roomsInRow(row) {
      return this.rooms.slice((row - 1) * this.columns, row * this.columns);
    },
    placeholdersInRow(row) {
      return this.columns - this.roomsInRow(row).length;
    },
  },
  created() {
    this.loading = true;
    const request = axios.get("/api/rooms").then((response) => {
      this.rooms = response.data.data;
      this.loading = false;
    });
  },
};
</script>