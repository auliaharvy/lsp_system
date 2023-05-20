export function assignUjiKomp(value) {
  localStorage.setItem('ujikomp', value);
}

export function getUjiKomp() {
  return localStorage.getItem('ujikomp');
}
