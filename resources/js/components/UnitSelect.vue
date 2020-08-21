<!-- Mengambil properti units{tipeUnits: [], units: []} -->
<template>
  <div>
    <select v-model="tipeUnitTerpilih">
      <option
        v-for="(tipeUnit, idx) in tipeUnits"
        :key="idx"
        :value="tipeUnit.id"
      >{{ tipeUnit.nama }}</option>
    </select>
    <select v-model="unitTerpilih" v-if="tipeUnitTerpilih" name="unit">
      <option
        v-for="(unit, idx) in unitOptions[tipeUnitTerpilih]"
        :key="idx"
        :value="unit.id"
      >{{unit.nama}}</option>
    </select>
  </div>
</template>

<script>
export default {
  props: ["units", "tipeUnits"],

  data() {
    return {
      tipeUnitTerpilih: null,
      unitTerpilih: null,
      unitOptions: {},
    };
  },
  created() {
    this.konversiUnits();
  },
  methods: {
    konversiUnits: function () {
      for (let unit of this.units) {
        let tipe_id = unit.tipe_unit_id;
        if (!this.unitOptions[tipe_id]) this.unitOptions[tipe_id] = [];
        this.unitOptions[tipe_id].push({
          id: unit.id,
          nama: unit.nama,
        });
      }
    },
  },
};
</script>