import {useForm} from "@inertiajs/react";
import {useState} from "react";
import {useRoute} from "ziggy-js";

const CheckTransaction = ({transaction}) => {
    const route = useRoute();
    const [checked, setChecked] = useState(transaction.checked);
    const {data, patch} = useForm({
        checked: checked
    });

    const handleClick = (e) => {
        e.preventDefault()
        data.checked = !checked;
        patch(route('transaction.patch', transaction.id), {
            onSuccess: () => {
                setChecked(!checked);
            },
        });
    }
    return (
        <input type={"checkbox"} onChange={handleClick} checked={checked}/>
    );
}

export default CheckTransaction;
