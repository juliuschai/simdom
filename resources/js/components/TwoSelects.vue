<!-- Mengambil properti seconds{firsts: [], seconds: []} -->
<template>
  <div>
    <!-- Firsts select box -->
    <select v-model="firstVal" :name="firstNameProp">
      <option v-for="(firstOpt, idx) in firsts" :key="idx" :value="firstOpt">{{ firstOpt }}</option>
    </select>
    <!-- Seconds select box -->
    <select v-model="secondVal" :name="secondNameProp">
      <option
        v-for="(secondOpt, idx) in secondOpts[firstVal]"
        :key="idx"
        :value="secondOpt"
      >{{secondOpt}}</option>
    </select>
  </div>
</template>

<script>
export default {
  props: [
    "seconds",
    "firsts",
    "firstVal",
    "secondVal",

    "secondNameProp",
    "firstNameProp",
    "textboxNameProp",
  ],

  data() {
    return {
      secondOpts: {},
    };
  },
  created() {
    this.convertSeconds();
  },
  methods: {
    convertSeconds: function () {
      // Convert from array of options into an array of array of options
      this.seconds.map((elm, idx) => {
        const { second_val, first_val } = elm;
        if (!this.secondOpts[first_val]) this.secondOpts[first_val] = [];
        this.secondOpts[first_val].push(second_val);
      });
    },
  },
};
</script>
