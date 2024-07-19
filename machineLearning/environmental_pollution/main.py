import numpy as np
import pandas as pd
from preprocess import data2matrix
from model import CNN
from sqlalchemy import create_engine
import torch
import torch.nn as nn
import torch.optim as optim
from torch.utils.data import TensorDataset, DataLoader
import csv



"""
Connecting to server
"""
host = 'den1.mysql6.gear.host'
db = 'situation'
usr = 'situation'
# psword = 'aichem567.'
psword = input("Please insert the password:")
engine = create_engine('mysql+pymysql://%s:%s@%s:%s/%s?charset=utf8'
                       % (usr, psword, host, '3306', db))
sql = "SELECT * FROM situation.o15_environmental_data;"
df_raw = pd.read_sql(sql, engine)
# print("Raw_data", df_raw)

"""
Data preprocessing
"""
labels, matrices = data2matrix(df_raw)
train_size = int(0.8 * len(matrices))
test_size = len(matrices) - train_size
train_dataset = TensorDataset(torch.stack(matrices[0:train_size]), torch.tensor(labels[0:train_size]))
test_dataset = TensorDataset(torch.stack(matrices[train_size:]), torch.tensor(labels[train_size:]))
train_loader = DataLoader(train_dataset, batch_size=2, shuffle=True)
test_loader = DataLoader(test_dataset, batch_size=2, shuffle=False)

train_loss = []
"""
Training model
"""
model = CNN()
criterion = nn.MSELoss()
optimizer = optim.Adam(model.parameters(), lr=0.008)
num_epochs = 20
for epoch in range(num_epochs):
    model.train()
    running_loss = 0.0
    for inputs, targets in train_loader:
        optimizer.zero_grad()
        outputs = model(inputs)
        loss = criterion(outputs, targets.unsqueeze(1).float())
        loss.backward(retain_graph=True)
        optimizer.step()
        running_loss += loss.item()

    train_loss.append(running_loss / len(train_loader))
    print(f'Epoch {epoch + 1}, Loss: {running_loss / len(train_loader):.4f}')

with open('data.csv', mode='w', newline='') as file:
    writer = csv.writer(file)
    for item in train_loss:
        writer.writerow([item])

"""
Test model
"""
model.eval()
total_loss = 0.0
total_samples = 0
correct_predictions = 0
error_threshold = 0.05
true_values = []
predictions = []

with torch.no_grad():
    for inputs, targets in test_loader:
        """
        Computing error
        """
        outputs = model(inputs)
        loss = criterion(outputs, targets.unsqueeze(1).float())
        total_loss += loss.item()

        """
        Computing Accuracy
        """
        true_values.append(targets)
        predictions.append(outputs)


true_values = torch.cat(true_values).numpy()
predictions = torch.cat(predictions).numpy()
errors = np.divide(np.abs(predictions - true_values), true_values)
mean_value = np.mean(errors)
print(f'Test Loss: {total_loss / len(test_loader):.4f}')
print(f'Test Accuracy: {(1 - mean_value)*100:.2f}%')


