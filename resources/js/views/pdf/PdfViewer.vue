<template>
  <div ref="pdfContainer" />
</template>

<script>
import Resource from '@/api/resource';
const print = new Resource('print-semua-module');

export default {
  data() {
    return {
      pdfUrl: null,
      dataUjiKomp: [
        { index: 1, name: 'APL 01', nameInDatabase: 'id_apl_01', idujikom: null, value: false },
        { index: 2, name: 'APL 02', nameInDatabase: 'id_apl_02', idujikom: null, value: false },
        { index: 3, name: 'MAPA 02', nameInDatabase: 'id_mapa_02', idujikom: null, value: false },
        { index: 4, name: 'AK 01', nameInDatabase: 'id_ak_01', idujikom: null, value: false },
        { index: 5, name: 'AK 04', nameInDatabase: 'id_ak_04', idujikom: null, value: false },
        { index: 6, name: 'IA 01', nameInDatabase: 'id_ia_01', idujikom: null, value: false },
        { index: 7, name: 'IA 02', nameInDatabase: 'id_ia_02', idujikom: null, value: false },
        { index: 8, name: 'IA 03', nameInDatabase: 'id_ia_03', idujikom: null, value: false },
        { index: 9, name: 'IA 05', nameInDatabase: 'id_ia_05', idujikom: null, value: false },
        { index: 10, name: 'IA 06', nameInDatabase: 'id_ia_06', idujikom: null, value: false },
        { index: 11, name: 'IA 07', nameInDatabase: 'id_ia_07', idujikom: null, value: false },
        { index: 12, name: 'IA 11', nameInDatabase: 'id_ia_11', idujikom: null, value: false },
        { index: 13, name: 'AK 02', nameInDatabase: 'id_ak_02', idujikom: null, value: false },
        { index: 14, name: 'AK 03', nameInDatabase: 'id_ak_03', idujikom: null, value: false },
        { index: 15, name: 'AK 05', nameInDatabase: 'id_ak_05', idujikom: null, value: false },
        { index: 16, name: 'AK 06', nameInDatabase: 'id_ak_06', idujikom: null, value: false },
        { index: 17, name: 'VA', nameInDatabase: 'id_va', idujikom: null, value: false },
        { index: 18, name: 'AK07', nameInDatabase: 'id_ak_07', idujikom: 3944, value: true },
      ],
    };
  },
  created() {
    this.loadPDF();
  },
  methods: {
    async loadPDF() {
      // URL endpoint untuk stream PDF dari Laravel
      const ujikomp = {
        iduji: 3944,
        asesor: this.asesor,
        idapl01: this.dataUjiKomp[0].idujikom,
        idapl02: this.dataUjiKomp[1].idujikom,
        idmapa02: this.dataUjiKomp[2].idujikom,
        idak01: this.dataUjiKomp[3].idujikom,
        idak04: this.dataUjiKomp[4].idujikom,
        idia01: this.dataUjiKomp[5].idujikom,
        idia02: this.dataUjiKomp[6].idujikom,
        idia03: this.dataUjiKomp[7].idujikom,
        idia05: this.dataUjiKomp[8].idujikom,
        idia06: this.dataUjiKomp[9].idujikom,
        idia07: this.dataUjiKomp[10].idujikom,
        idia11: this.dataUjiKomp[11].idujikom,
        idak02: this.dataUjiKomp[12].idujikom,
        idak03: this.dataUjiKomp[13].idujikom,
        idak05: this.dataUjiKomp[14].idujikom,
        idak06: this.dataUjiKomp[15].idujikom,
        idva: this.dataUjiKomp[16].idujikom,
        idak07: this.dataUjiKomp[17].idujikom,
        valueapl01: this.dataUjiKomp[0].value,
        valueapl02: this.dataUjiKomp[1].value,
        valuemapa02: this.dataUjiKomp[2].value,
        valueak01: this.dataUjiKomp[3].value,
        valueak04: this.dataUjiKomp[4].value,
        valueia01: this.dataUjiKomp[5].value,
        valueia02: this.dataUjiKomp[6].value,
        valueia03: this.dataUjiKomp[7].value,
        valueia05: this.dataUjiKomp[8].value,
        valueia06: this.dataUjiKomp[9].value,
        valueia07: this.dataUjiKomp[10].value,
        valueia11: this.dataUjiKomp[11].value,
        valueak02: this.dataUjiKomp[12].value,
        valueak03: this.dataUjiKomp[13].value,
        valueak05: this.dataUjiKomp[14].value,
        valueak06: this.dataUjiKomp[15].value,
        valueva: this.dataUjiKomp[16].value,
        valueak07: this.dataUjiKomp[17].value,
      };

      await print.stream(ujikomp)
      .then((response) => {
        const blob = new Blob([response], { type: 'application/pdf' });
        const url = window.URL.createObjectURL(blob);
        
        console.log(response)
        
        // Membuka di tab baru
        // window.open(url, '_blank');
        
        // Jika ingin menampilkan di dalam halaman:
        const iframe = document.createElement('iframe');
        iframe.src = url;
        iframe.width = '100%';
        iframe.height = '600px'; // sesuaikan ukuran

        this.$refs.pdfContainer.appendChild(iframe);   
      })
      .catch((err) => {
        console.log(err);
        this.handleErrorPrint(err);
      });
    }
  }
};
</script>
