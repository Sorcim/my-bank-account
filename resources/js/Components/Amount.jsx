const Amount = ({ amount }) => {
    const color = amount > 0 ? 'text-green-500' : 'text-red-500';
    return <span className={color}>{amount.toLocaleString('fr-FR', { style: "currency", currency: "EUR" })}</span>
}

export default Amount;
