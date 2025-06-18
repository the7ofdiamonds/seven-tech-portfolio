import React, { useState, ChangeEvent } from 'react'

import { Image, ProjectOnboarding } from '@the7ofdiamonds/github-portfolio';

import styles from './Logos.module.scss';

interface LogosProps {
    projectOnboarding: ProjectOnboarding | null;
    setVal: (value: ProjectOnboarding) => void;
}

const Logos: React.FC<LogosProps> = ({ projectOnboarding, setVal }) => {
    const [onboarding, setOnboarding] = useState<ProjectOnboarding>(new ProjectOnboarding);
    const [logos, setLogos] = useState<Array<Image>>(
        projectOnboarding?.logos ? Array.from(projectOnboarding.logos) : []
    );

    const handleInputChange = (e: ChangeEvent<HTMLInputElement>) => {
        const { name, value } = e.target;
        setVal(onboarding)
    };

    return (
        <tr id="logo">
            <td>
                <label htmlFor="logos">
                    Does (your company or organization) have a logo? If Yes,
                    provide a link to it below.
                </label>
                <div className="options-column">
                    {logos.map((logo) => (
                        <span className="option">
                            <div className="image">
                                <img src={logo.url} alt={logo.title} />
                            </div>
                            <input
                                type="url"
                                id={`logo_${logo.id}`}
                                name={`logo_${logo.id}`}
                                className={styles.input}
                                value={logo.url ?? ''}
                                onChange={handleInputChange}
                            />
                        </span>
                    ))}
                </div>
            </td>
        </tr>
    )
}

export default Logos