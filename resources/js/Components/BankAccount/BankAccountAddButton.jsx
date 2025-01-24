import {PlusSmallIcon} from "@heroicons/react/20/solid/index.js";
import {useModal} from "../../Contexts/ModalContext.jsx";
import BankAccountAddForm from "./BankAccountAddForm.jsx";

const BankAccountAddButton = () => {
    const {openModal} = useModal();
    return (
        <button
            onClick={() => openModal(<BankAccountAddForm />)}
            className="ml-auto flex items-center gap-x-1 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
        >
            <PlusSmallIcon aria-hidden="true" className="-ml-1.5 size-5"/>
            Nouveau Compte
        </button>
    );
}

export default BankAccountAddButton;
