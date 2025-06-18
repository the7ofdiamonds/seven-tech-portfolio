import React, { ChangeEvent } from 'react'

import styles from './OptionInput.module.scss';

interface OptionInputProps {
    id: string;
    label: string;
    type: string;
    value: string;
    changeFunc: (e: ChangeEvent<HTMLInputElement>) => void;
}

const OptionInput: React.FC<OptionInputProps> = ({ id, label, type, value, changeFunc }) => {
    return (
        <span className={styles.option}>
            <label htmlFor={id}>{label}</label>
            <input
                type={type}
                id={id}
                name={id}
                className={styles.input}
                value={value}
                onChange={(e) => changeFunc(e)}
            />
        </span>
    )
}

export default OptionInput