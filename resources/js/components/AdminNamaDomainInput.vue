<style scoped>
.hide {
  display: none;
}

.disabled {
  background-color: #e9ecef;
  opacity: 1;
  pointer-events: none;
}
</style>

<template>
  <div>
    <input type="text" class="col disabled" name="namaDomain" :value="namaDomain" />
    <div class="row">
      <input type="text" v-model="prepend.val" class="col" :class="{hide: !prepend.active}" />
      <input type="text" v-model="selTemplate" class="col disabled" disabled />
      <input type="text" v-model="append.val" class="col" :class="{hide: !append.active}" />
    </div>
    <select v-model="selTemplate" class="form-control">
      <option value>Pilih salah satu</option>
      <option value="*.its.ac.id">*.its.ac.id</option>
      <option v-for="(template, idx) in templates" :key="idx" :value="template">{{template}}</option>
    </select>
  </div>
</template>

<script>
export default {
  props: {
    templates: {
      type: Array,
      default: [],
    },
    selTemplateProp: {
      type: String,
      default: "",
    },
    namaDomainProp: {
      type: String,
      default: null,
    },
  },

  data() {
    return {
      prepend: { active: false, val: "" },
      append: { active: false, val: "" },
      selTemplate: "",
    };
  },

  created() {
    this.selTemplate = this.selTemplateProp;
    this.namaDomainLama = this.namaDomainProp;
  },

  methods: {
    isSelTemplateSubdir: function () {
      return this.selTemplate.endsWith("*");
    },
    stripAsterix: function (inStr) {
      return inStr.replace("*", "");
    },
  },

  computed: {
    namaDomain: function () {
      this.selTemplate;
      this.prepend.val;
      this.append.val;
      if (this.namaDomainLama != null) {
        // if first time running, set it as the namaDomainLama prop
        const namaDomainLama = this.namaDomainLama;
        this.namaDomainLama = null;
        return namaDomainLama;
      } else {
        return (
          this.prepend.val +
          this.stripAsterix(this.selTemplate) +
          this.append.val
        );
      }
    },
  },

  watch: {
    selTemplate: function () {
      if (this.isSelTemplateSubdir()) {
        this.prepend.active = false;
        this.prepend.val = "";
        this.append.active = true;
        this.append.val = "";
      } else {
        this.prepend.active = true;
        this.prepend.val = "";
        this.append.active = false;
        this.append.val = "";
      }
    },
  },
};
</script>