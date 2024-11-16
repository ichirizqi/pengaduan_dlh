<template>
  <div class="modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Unduh Excel Data Pengaduan Verifikasi</h4>
          <button type="button" class="btn btn-sm" v-on:click="closeModal">
          <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Masukkan Tahun Untuk Mengunduh Laporan Pengaduan Verifikasi</p>
            <div class="flex flex-col ">
              <input type="number" v-model="year" class="form-control" placeholder="Masukkan Tahun" >
              <!-- <div class="flex flex-row mt-3 justify-end">                                
              <button type="submit" @click.prevent="exportData()" class="btn btn-success">Unduh</button>
              </div> -->
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit"  @click.prevent="exportData()" class="btn btn-success">Unduh</button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  export default {
    name: 'modal',
   data(){
      return {
        year: ''
      }
    },
    methods: {
      exportData() {
        this.$emit('close-modal');
            window.open(`http://localhost:8000/api/pengaduan/export?year=${this.year}`, {
            })
      },
      closeModal() {
        this.$emit('close-modal');
      },
    },
  };
</script>
<style scoped>
  .modal {
  position: fixed;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  z-index: 1050;
  display: block;
  overflow: hidden;
  outline: 0;
  background-color: rgba(0, 0, 0, 0.6);
  }
</style>
