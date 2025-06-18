import React, { useState, ChangeEvent } from 'react'

import { Color, ProjectOnboarding } from '@the7ofdiamonds/github-portfolio';

interface ColorsProps {
    projectOnboarding: ProjectOnboarding | null;
    setVal: (value: ProjectOnboarding) => void;
}

const Colors: React.FC<ColorsProps> = ({ projectOnboarding, setVal }) => {
    const [onboarding, setOnboarding] = useState<ProjectOnboarding>(new ProjectOnboarding);
    const [colors, setColors] = useState<Array<Color>>(
        projectOnboarding?.colors ? Array.from(projectOnboarding.colors) : []
    );

    const handleColorInputChange = (e: ChangeEvent<HTMLInputElement>) => {


        setVal(onboarding)
    };

    return (
        <tr id="colors">
            <td>
                <label htmlFor="colors">
                    Does (your company or organization) have colors? If Yes,
                    provide them below.
                </label>
                <div className="options-column">
                    {colors.map((color) => (
                        <div key={color.id} className="color-input">
                            <label htmlFor={color.name}>{color.name}</label>
                            <input
                                type="color"
                                id={color.id}
                                name={color.name}
                                value={color.value}
                                onChange={(e) =>
                                    handleColorInputChange(e)
                                }
                            />
                        </div>
                    ))}
                </div>
            </td>
        </tr>
    )
}

export default Colors