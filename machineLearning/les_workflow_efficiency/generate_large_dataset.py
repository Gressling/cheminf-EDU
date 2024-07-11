import pandas as pd
import numpy as np
from datetime import datetime, timedelta

# Anzahl der zu generierenden Einträge
n_entries = 1000

# Erstellen der Basisdaten
data = {
    'TaskID': range(1, n_entries + 1),
    'TaskStatus': np.random.choice(['pending', 'in-progress', 'completed'], n_entries),
    'ResourceAllocated': [f'Resource{i}' for i in np.random.randint(1, 11, n_entries)],
    'TimeSpent': np.round(np.random.uniform(0, 5, n_entries), 2),
    'Reward': np.round(np.random.uniform(0, 3, n_entries), 2),
}

# Erstellen des DataFrame
df = pd.DataFrame(data)

# Generieren der Timestamps
start_date = datetime(2024, 1, 1)
df['Timestamp'] = [start_date + timedelta(minutes=i*30) for i in range(n_entries)]

# Speichern als CSV
df.to_csv('large_laboratory_tasks.csv', index=False)

print("Die CSV-Datei 'large_laboratory_tasks.csv' wurde erfolgreich erstellt.")

