export default function DateFormat(currentDate, getAll = true) {
  const provideDate = new Date(currentDate);
  const date = provideDate.getDate();
  /* for string month */
  const month = provideDate.toDateString();
  const monthFormat = month.split(" ");
  const year = provideDate.getFullYear();
  if (getAll) {
    return `${date} ${monthFormat[1]} ${year}`;
  }
  return {
    date,
    month: monthFormat[1],
    year,
  };
}
