const Time = ({ date }) => {
    if (!date) return <span>Aucune date</span>;

    const parsedDate = date instanceof Date ? date : new Date(date);

    return <span>{new Intl.DateTimeFormat("fr-FR").format(parsedDate)}</span>
}

export default Time;
