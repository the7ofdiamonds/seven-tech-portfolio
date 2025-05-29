import React from 'react';

import { IconComponent, Taxonomy } from '@the7ofdiamonds/github-portfolio';

interface TaxTableComponentProps {
  terms: Array<Taxonomy>;
}

const TaxTableComponent: React.FC<TaxTableComponentProps> = ({ terms }) => {

  return (
    Array.isArray(terms) && (
      <table>
        <tbody>
          {terms.map((tax, index) => (
            <tr>
              <td>
                <IconComponent key={index} icon={tax.icon} url={tax.url} />
              </td>
              <td>
                <h3>{tax.title}</h3>
              </td>
            </tr>
          ))}
        </tbody>
      </table>
    )
  );
}

export default TaxTableComponent;
