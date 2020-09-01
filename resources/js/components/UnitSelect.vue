<!-- Mengambil properti secondOptions{firstOptions: [], secondOptions: []} -->
<template>
  <div>
    <select v-model="firstValue">
      <option
        v-for="(firstOption, idx) in firstOptions"
        :key="idx"
        :value="firstOption.id"
      >{{ firstOption.nama }}</option>
    </select>
    <select v-model="secondValue" :name="nameProp">
      <option
        v-for="(secondOption, idx) in secondOptions[firstValue]"
        :key="idx"
        :value="secondOption.id"
      >{{secondOption.nama}}</option>
    </select>
  </div>
</template>

<script>
export default {
  props: ["secondOptions", "firstOptions", "value", "nameProp"],

  data() {
    return {
      firstValue: null,
      secondValue: null,
      secondOptions: {},
    };
  },
  created() {
    this.convertSecondOptions();
  },
  methods: {
    convertSecondOptions: function () {
      for (let secondOption of this.secondOptions) {
        if (value && secondOption.id === value) {
          firstValue = secondOption.tipe_unit_id;
          secondValue = secondOption.id;
        }
        let tipe_id = secondOption.tipe_unit_id;
        if (!this.secondOptions[tipe_id]) this.secondOptions[tipe_id] = [];
        this.secondOptions[tipe_id].push({
          id: secondOption.id,
          nama: secondOption.nama,
        });
      }
    },
  },
};
</script>