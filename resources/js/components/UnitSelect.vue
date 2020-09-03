<!-- Mengambil properti seconds{firsts: [], seconds: []} -->
<template>
  <div>
    <select v-model="firstValue">
      <option v-for="(firstOpt, idx) in firsts" :key="idx" :value="firstOpt.id">{{ firstOpt.nama }}</option>
    </select>
    <select v-model="secondValue" :name="nameProp">
      <option
        v-for="(secOpt, idx) in secOpts[firstValue]"
        :key="idx"
        :value="secOpt.id"
      >{{secOpt.nama}}</option>
    </select>
  </div>
</template>

<script>
export default {
  props: ["seconds", "firsts", "optionValue", "nameProp"],

  data() {
    return {
      firstValue: null,
      secondValue: null,
      secOpts: {},
    };
  },
  created() {
    this.convertSeconds();
  },
  methods: {
    convertSeconds: function () {
      // for (const second of this.seconds) {
      //   const tipe_id = second.tipe_unit_id;
      //   if (!this.secOpts[tipe_id]) this.secOpts[tipe_id] = [];
      //   this.secOpts[tipe_id].push({
      //     id: second.id,
      //     nama: second.nama,
      //   });

      //   if (this.optionValue && second.id == this.optionValue) {
      //     this.firstValue = second.tipe_unit_id;
      //     this.secondValue = second.id;
      //   }
      // }

      // Convert from array of options into an array of array of options
      this.seconds.map((elm, idx) => {
        const { tipe_unit_id, id, nama } = elm;
        if (!this.secOpts[tipe_unit_id]) this.secOpts[tipe_unit_id] = [];
        this.secOpts[tipe_unit_id].push({ id, nama });
      });

      // Select option, if the optionValue is defined
      const selSecond = this.seconds.find((val, idx) => {
        return this.optionValue && val.id == this.optionValue;
      });

      if (selSecond) {
        this.firstValue = selSecond.tipe_unit_id;
        this.secondValue = selSecond.id;
      }
    },
  },
};
</script>