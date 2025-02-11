import BaseLayout from "../Layout/BaseLayout";
import BankAccountCard from "../Components/BankAccount/BankAccountCard.jsx";
import BankAccountAddButton from "../Components/BankAccount/BankAccountAddButton.jsx";

const Home = ({paginatedBankAccounts}) =>{
    console.log(paginatedBankAccounts);
    return (
        <>
            <div className="flex items-center justify-between">
                <h2 className="text-base/7 font-semibold text-gray-900">Vos Comptes Bancaires</h2>
                <BankAccountAddButton/>
            </div>
            <ul role="list" className="mt-6 grid grid-cols-1 gap-x-6 gap-y-8 lg:grid-cols-3 xl:gap-x-8">
                {paginatedBankAccounts.bankAccounts.map((bankAccount) => (
                    <BankAccountCard key={bankAccount.id} bankAccount={bankAccount}/>
                ))}
            </ul>
        </>
    );
}

Home.layout = page => <BaseLayout children={page} title="Welcome"/>

export default Home;
