export default function formatDate(date) {
  const options = {
    weekday: 'short',
    day: 'numeric',
    month: 'short',
    year: 'numeric'
  };

  return new Date(date).toLocaleDateString('pt-BR', options);
}
